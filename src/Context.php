<?php


namespace App;


class Context
{
    public static $profiles = [
        'joey' => '91',
        'mei' => '99',
    ];

    public static function getPassword(string $key)
    {
        return static::$profiles[$key];
    }
}
