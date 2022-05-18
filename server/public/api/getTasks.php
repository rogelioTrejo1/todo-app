<?php
require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Classes
use models\Task;
use config\Headers;
use config\Keys;
use utils\Http_Response;

// Variables globales
$http_method = $_SERVER['REQUEST_METHOD'];
define("HTTP_METHOD", "GET");

// Establezco una respuesta CORS
Headers::set_headers();

// Valido que sea el metodo principal
if ($http_method != HTTP_METHOD) {
    Http_Response::response_json(400, [
        "message" => "Error to request the resource"
    ]);
    die();
}

try {
    // Obtengo los recurso de petición
    $tasks = Task::getAll();

    // Establesco la respuesta al cliente
    Http_Response::response_json(200, $tasks);
} catch (Exception $e) {
    // Mando el error interno de la plataforma
    Http_Response::response_json(500, [
        "message" => "Internal server error",
        "error" => Keys::getKey('APP_ENV') == 'dev' ? $e->getMessage() : null
    ]);
}
