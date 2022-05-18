<?php

namespace config;

class Headers
{
    public static function set_headers(): void
    {
        header("Content-Type: application/json;charset=utf-8");
    }

    public static function set_cors(): void
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    }
}
