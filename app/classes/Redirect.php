<?php

namespace App\Classes;

/**
 * Manage Redirects
 *
 **/
class Redirect
{
    
    /**
     * Redirect to a page
     *
     * @param string $url
     *
     **/
    public static function to($url)
    {
        header("location: $url");
    }
    
    /**
     * Redirect back to same page
     *
     * @param string $url
     *
     **/
    public static function back()
    {
        $url = $_SERVER['REQUEST_URI'];
        
        header("location: $url");
    }
}
