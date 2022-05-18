<?php
require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Classes
use models\Task;
use config\Headers;
use utils\Http_Response;
use config\Keys;

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

// Valido si existe el parametro
if (!isset($_GET['id']) || empty($_GET['id'])) {
    Http_Response::response_json(400, [
        "message" => "Error to request the resource"
    ]);
    die();
}

try {
    // Obtengo el id de la tarea
    $id = $_GET['id'];

    // Obtengo los recurso de petición
    $task = Task::getOne($id);

    // Valido si existe el recurso
    if (count($task) > 0)
        Http_Response::response_json(200, $task);
    else
        Http_Response::response_json(404, [
            "message" => "Resource not found"
        ]);
} catch (Exception $e) {
    Http_Response::response_json(500, [
        "message" => "Internal server error",
        "error" => Keys::getKey('APP_ENV') == 'dev' ? $e->getMessage() : null
    ]);
}
