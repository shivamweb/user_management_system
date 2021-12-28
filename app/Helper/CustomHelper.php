<?php

use Stevebauman\Location\Facades\Location;

if (!function_exists('textToUpper')) {
    function textToUpper($string)
    {
        return strtoupper($string);
    }
}

class CustomHelper
{
    public function get_user_loction()
    {
        $ip = request()->ip(); // Dynamic IP address
        $data = Location::get($ip);

        if ($data) {
            return  $data;
        } else {
            return (Location::get('14.99.243.210'));
        }
    }
}
