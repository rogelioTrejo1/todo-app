<?php
// Importacion del autoload
require_once __DIR__ . "/../autoload.php";

// Mando la respuesta al cliente
echo json_encode(
    [
        "Message" => "Wellcome to my api"
    ]
);
