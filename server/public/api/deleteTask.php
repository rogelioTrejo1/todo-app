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
define("HTTP_METHOD", "DELETE");

// Establezco las cabecera de respuesta
Headers::set_headers();

// Valio que sea el metodo principal
if ($http_method == HTTP_METHOD) {
    // Valido que exista los parametros
    if (isset($_GET['id']) || !empty($_GET['id'])) {
        try {
            // Obtengo los recurso de petición
            $id = $_GET['id'];
            Task::delete($id);
            $http_status_code = 200;
        } catch (Exception $e) {
            // Mando el error interno de la plataforma
            $http_status_code = 500;
            $http_response_body = [
                "message" => "Internal server error"
            ];
        }
    } else {
        // Respueta para el cliente si usa mal la peticion http
        $http_status_code = 400;
        $http_response_body = [
            "message" => "Error to request the resource"
        ];
    }
} else {
    // Respueta para el cliente si usa mal la peticion http
    $http_method = [
        "message" => "Error to request the resource"
    ];
    $http_status_code = 400;
}
