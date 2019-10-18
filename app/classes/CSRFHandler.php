<?php

namespace App\Classes;

/**
 * Secure CSRF token validator and generator
 *
 **/

class CSRFHandler
{
    
    /**
     * @var int Number of bytes used in generating Tokens
     *
     **/
    const TOKEN_LENGTH = 32;

    /**
     * Encrypts the token using a one way hashing algorithm
     *
     * @param string $token Actual token
     *
     * @param string $salt Randomly generated salt
     *
     * @return The encrypted token
     *
     **/
    protected function encryptToken($token, $salt)
    {
        return hash_hmac('sha256', $token, $salt, true);
    }

    /**
     * Generates a new base64 encoded Token for Request
     *
     * The output string contains both the Encrypted actual 32 byte random string
     * stored in SESSION variable and the Salt used to encrypt it.
     * This method returns a new string every time it is called, because it
     * always generates a new Salt for each call.
     *
     * @return string Base64 encoded Token for Request
     *
     **/
    public static function getToken()
    {
        $handler = new static;
        
        $salt = random_bytes(self::TOKEN_LENGTH);

        return base64_encode($salt . $handler->encryptToken($handler->getTrueToken(), $salt));
    }

    /**
     * Returns the current actual CSRF Token.
     *
     * This returns the current actual 32 byte random string that is
     * available in SESSION variable, which is used to validate
     * against the tokens submitted in the requests.
     * If the CSRF token is not available, it calls CSRFHandler::regenerate
     * to generate new token and store it in SESSION variable.
     *
     * @return string the current actual CSRF token
     *
     **/
    protected function getTrueToken()
    {
        $token = $this->getStoredToken();

        if (strlen($token) !== self::TOKEN_LENGTH) {
            $token = self::regenerateToken();
        }

        return $token;
    }

    /**
     * Retrieve token from the SESSION variable
     *
     * @return string the current actual CSRF token
     *
     **/
    public function getStoredToken()
    {
        if (!Session::isActive()) {
            throw new \Exception("Error Processing Request. No Active Session");
        }

        if (!Session::hasKey('token')) {
            return '';
        }
            
        $token = Session::getValueFor('token');
        
        return base64_decode($token, true);
    }

    /**
     * Store token in the SESSION variable
     *
     * @param string the current actual CSRF token
     *
     **/
    public function storeToken($token)
    {
        if (!Session::isActive()) {
            throw new \Exception("Error Processing Request. No Active Session");
        }

        $key = base64_encode($token);

        Session::setValueFor('token', $key);
    }

    /**
     * Regenerates the actual CSRF token
     *
     * After this method has been called, any token that has been previously
     * generated by `getToken()` is no longer considered valid. It is highly
     * recommended to regenerate the CSRF token after any user authentication.
     *
     * @return CSRFHandler Returns self for call chaining
     *
     * @throws Storage\TokenStorageException If the secret token cannot be stored
     *
     */
    public static function regenerateToken()
    {
        $currentToken = self::getStoredToken();

        do {
            $token = random_bytes(self::TOKEN_LENGTH);
        } while ($token === $currentToken);

        self::storeToken($token);

        if (empty($currentToken)) {
            return $token;
        }
    }

    /**
     * Validates the token sent in the Request
     *
     * The token must be provided as a base64 encoded string. This string
     * contains both Encrypted CSRF token and the Salt used to encrypt it.
     * In other words, you should pass this method the exact same string
     * that has been returned by the `getToken()` method
     *
     * @param string $token The base64 encoded Token in the request
     *
     * @return bool True if the token is valid
     *
     **/
    public static function validateToken($token)
    {
        if (!is_string($token)) {
            return false;
        }

        $actualToken = base64_decode($token);

        if (strlen($actualToken) !== 2* self::TOKEN_LENGTH) {
            return false;
        }

        list($salt, $encrypted) = str_split($actualToken, self::TOKEN_LENGTH);

        $handler = new static;

        $compare = [$handler, 'compare'];

        return call_user_func(
            $compare,
            $handler->encryptToken($handler->getTrueToken(), $salt),
            $encrypted
        );
    }

    /**
     * Compare two strings in constant time.
     * This is to prevent timing attack
     *
     * @param string $knownstring
     *
     * @param string $userstring
     *
     * @return bool True if strings are equal, false if not
     *
     **/
    protected function compare($knownString, $userString)
    {
        return hash_equals($knownString, $userString);
    }
}

 ?>



 