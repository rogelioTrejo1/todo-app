<?php
// Importo la conexión a la base de datos
require_once __DIR__ . '/db/database.php';

// Valido que exista todas las variables que envia en cliente
if (
    !isset($_POST['id']) || empty($_POST['id']) ||
    !isset($_POST['title']) || empty($_POST['title']) ||
    !isset($_POST['description']) || empty($_POST['description'])
) {
    echo "Cuerpo de la petición incorrecto";
    die();
}

// Guardo el cuerpo de la petición
$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];

// Creo y ejecuto la sentencia SQL
$sql = "INSERT INTO task(id,name, description) VALUES (:id,:title, :description);";
$stmt = $conn->prepare($sql);

// Aplico los valores a la sentencia para evitar sql injection
$stmt->bindValue(':id', $id);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':description', $description);

// Valido que la sentencia se ejecute correctamente
if (!$stmt->execute()) {
    echo 'Error al ejecutar la sentencia';
    die();
}

// Envio una respusta al cliente
echo "Tarea creada correctamente";
