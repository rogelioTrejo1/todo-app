<?php
// Importo la conexión a la base de datos
require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Classes
use models\Task;
use config\Headers;

// Variables globales
$http_method = $_SERVER['REQUEST_METHOD'];
$http_status_code = null;
$http_response_body = null;
define("HTTP_METHOD", "GET");

// Establezco una respuesta CORS
Headers::set_headers();

// Valido que sea el metodo principal
if ($http_method == HTTP_METHOD) {
    try {
        // Obtengo los recurso de petición
        $tasks = Task::getAll();

        // Establesco la respuesta al cliente
        $http_status_code = 200;
        $http_response_body = $tasks;
    } catch (Exception $e) {
        // Mando el error interno de la plataforma
        $http_status_code = 500;
        $http_response_body = [
            "message" => "Internal server error"
        ];
    }
} else {
    // Respueta para el cliente si usa mal la peticion http
    $http_method = [
        "message" => "Error al solicitar el recurso"
    ];
    $http_status_code = 400;
}

// transformo la respueta en json
$json = json_encode($tasks);

// Mando la respusta al cliente transformada en json
Headers::set_headers();
http_response_code($http_status_code);
echo $json;
