<?php

class Configs
{
    static private $configs = [

        "DB" => [
                "servername" => "127.0.0.1",
                "username" => "username",
                "password" => "password",
                "dbname" => "dbname"
         ],

    ];

    public static function get($key)
    {
        return self::$configs[$key];
    }


}