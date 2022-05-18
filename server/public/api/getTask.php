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
    // Se valida el parametro que exista
    if (isset($_GET['id']) || !empty($_GET['id'])) {
        try {
            // Obtengo el id de la tarea
            $id = $_GET['id'];

            // Obtengo los recurso de petición
            $task = Task::getOne($id);

            // Establesco la respuesta al cliente
            $http_status_code = 200;
            $http_response_body = $task;
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
    $http_method = [
        "message" => "Error al solicitar el recurso"
    ];
    $http_status_code = 400;
}

// transformo la respueta en json
$json = json_encode($task);

// Mando la respusta al cliente transformada en json
Headers::set_headers();
http_response_code($http_status_code);
echo $json;
