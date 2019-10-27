<?php 

namespace App\Classes;

/**
 * Class to Manage Session data
 *
 **/
class Session {
	
	/**
	 * Check if session is active
	 *
	 * @return bool True if session is Active, False if not.
	 *
	 **/
	public static function isActive()
	{

		return session_status() === PHP_SESSION_ACTIVE;

	}

	/**
	 * Get Session data
	 *
	 * @param string $name
	 *
     * @return mixed
     */
    public static function getValueFor( $key )
    {
        
        if ( empty( $key ) ) {
        	
        	throw new \Exception("Session key cannot be empty");
        	
        }

        return $_SESSION[$key];

    }

    /**
	 * Flush Session data
	 *
	 * @param string $name
	 *
     * @return mixed
     */
    public static function flush( $key )
    {
        
        if ( !self::hasKey($key) ) {
        	
        	return null;
        	
        }

        $oldValue = self::getValueFor($key);

        self::removeKey($key);

        return $oldValue;

    }

    /**
	 * Check for Session key
	 *
	 * @param string $key
	 *
	 * @return bool
	 *
	 **/
	public static function hasKey ( $key )
	{
		
		if ( empty( $key ) ) {
        	
        	throw new \Exception("Session key cannot be empty");
        	
        }

		return isset($_SESSION[$key]) ? true : false; 

	}

	/**
	 * Remove Session data
	 *
	 * @param string $key
	 *
	 **/
	public static function removeKey ( $key )
	{
		
		if (self::hasKey($key)) {
			
			unset( $_SESSION[$key] );	
			
		}

	}

    /**
     * Set Session data
     *
     * @param mixed $name
     *
     * @return self
     */
    public static function setValueFor( $key, $value)
    {
        
        if( empty($key) || empty($value))
        {

        	throw new \Exception("Session key {$key} or value {$value} is empty");
        	
        }
        
        $_SESSION[$key] = $value;

    }
}

 ?>

