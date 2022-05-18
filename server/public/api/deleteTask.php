<?php
// Importo la conexión a la base de datos
require_once __DIR__ . '/db/database.php';

// Valido que exista el id por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Parametro de busqueda incorrecto";
    die();
}

// Guardo el id en una variable
$id = $_GET['id'];

// Genero la sentencia SQL y la ejecuto
$sql = "DELETE FROM task WHERE id = :id;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id);

// Valido que la sentencia se ejecute correctamente
if (!$stmt->execute()) {
    echo 'Error al ejecutar la sentencia';
    die();
}

// Envio la respuesta al cliente
echo 'Tarea eliminada';
