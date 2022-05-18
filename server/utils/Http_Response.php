<?php

namespace utils;

use config\Headers;

class Http_Response
{
    public static function response_json(int $http_status_code, array $http_body = null)
    {
        // Se manda una respuesta vacia al cliente si el body esta vacio
        if (is_null($http_body)) {
            Headers::set_headers();
            http_response_code($http_status_code);
            return;
        }

        // Se manda una respuesta normal al cliente
        Headers::set_headers();
        http_response_code($http_status_code);
        echo json_encode($http_body);
    }

    public static function response_xml(int $http_status_code, string $http_body = null)
    {
        // Todo: Implementar
    }
}
