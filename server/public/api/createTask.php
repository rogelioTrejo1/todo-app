<?php
require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Classes
use models\Task;
use config\Headers;

// Variables globales
$http_method = $_SERVER['REQUEST_METHOD'];
$http_status_code = null;
$http_response_body = null;
define("HTTP_METHOD", "POST");

// Establezco una respuesta CORS
Headers::set_headers();

// Valido que sea el metodo principal
if ($http_method == HTTP_METHOD) {
    // Obtengo el cuerpo en JSON
    $body = json_decode(file_get_contents("php://input"), true);

    // Valido que el cuerpo sea correcto o no este vacio
    if (
        (isset($body['id']) || !empty($body['id'])) &&
        (isset($body['title']) || !empty($body['title'])) &&
        (isset($body['description']) || !empty($body['description']))
    ) {
        try {
            // Creo una nueva tarea
            Task::create($body);

            // Establezco una respuesta exitosa
            $http_status_code = 201;
        } catch (Exception $e) {
            // Establezco una respuesta de error
            $http_status_code = 500;
            $http_response_body = [
                'message' => 'Internal Server Error',
                'exception' => $e
            ];
        } catch (Exception $e) {
            // Mando el error interno de la plataforma
            $http_status_code = 500;
            $http_response_body = [
                "message" => "Internal server error"
            ];
        }
    } else {
        // Mando el error de una peticion erronea
        $http_status_code = 400;
        $http_response_body = [
            "message" => "Body is bad!"
        ];
    }
} else {
    // Respueta para el cliente si usa mal la peticion http
    $http_status_code = 400;
    $http_response_body = [
        "message" => "Error to request the resource"
    ];
}

// transformo la respueta en json
$json = json_encode($http_response_body);

// Mando la respusta al cliente transformada en json
Headers::set_headers();
http_response_code($http_status_code);
if ($http_status_code != 201)
    echo $json;
