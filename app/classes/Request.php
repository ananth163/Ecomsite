<?php

namespace App\Classes;

/**
 * Manage the Requests
 **/
class Request
{
    
    /**
     * Specifies that the fetch method shall return each requestType as an object
     * with property names that correspond to the corresponding field names mentioned
     * in HTML form.
     **/
    const FETCH_OBJ = false;

    /**
     * Specifies that the fetch method shall return each requestType as an array
     * indexed by requestType
     **/
    const FETCH_ASSOC = true;

    /**
     * Fetches all the available requests
     * The fetchMode parameter determines how it returns the result.
     * This value must be one of the Request::FETCH_* constants
     *
     * @return mixed $result The return value of this function depends on the fetch type
     *
     **/
    public static function fetchAll( $fetchMode = Request::FETCH_OBJ)
    {
        if (count($_GET) > 0) {
            $result['GET'] = $_GET;
        }

        if (count($_POST) > 0) {
            $result['POST'] = $_POST;
        }

        if (count($_FILES) > 0) {
            $result['file'] = $_FILES;
        }

        return json_decode(json_encode($result), $fetchMode);
    }

    /**
     * Check the availability of a particular requestType
     * for e.g. if it has POST request
     *
     * @param string $requestType 'GET' or 'POST' or 'FILES'
     *
     * @return bool True if present, False if not
     *
     **/
    public static function hasType($requestType)
    {
        return array_key_exists($requestType, self::fetchAll(Request::FETCH_ASSOC));
    }

    /**
     * Fetch requests of a particular type
     *
     * @param $requestTpe GET or POST or FILES
     *
     * @return object returns JSON object with properties as different field in
     *                        HTML form
     **/
    public static function fetchType($requestType, $fetchMode = Request::FETCH_OBJ)
    {
        if ($fetchMode) {
        	
        	return self::fetchAll($fetchMode)[$requestType];
        }

        return self::fetchAll()->$requestType;
    }

    /**
     * Get the query string value from URL
     *
     * @param $key
     *
     * @return $value Returns the value of query
     *
     **/
    public static function query ( $key)
    {
        return $_GET[$key] ?? null;
    }

    /**
     * Get the POST input
     *
     * @param $key
     *
     * @return $value Returns the value of input
     *
     **/
    public static function input ( $key)
    {
        return $_POST[$key] ?? null;
    }

    /**
     * Refresh the request
     *  Clears the request values
     **/
    public static function refresh()
    {
        $_FILES = [];
        $_POST  = [];
        $_GET   = [];
    }
}
