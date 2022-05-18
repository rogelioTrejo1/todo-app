<?php
// Importo la conexion de la base de datos
require_once __DIR__ . '/db/database.php';

// Obtengo el cuerpo de la peticion
if (
    !isset($_POST['id']) || empty($_POST['id']) ||
    !isset($_POST['title']) || empty($_POST['title']) ||
    !isset($_POST['description']) || empty($_POST['description'])
) {
    echo "Cuerpo de la peticion Invalido!";
    die();
}

// Obtengo las variables globales
$id = $_POST['id'];
$name = $_POST['title'];
$description = $_POST['description'];

// Valido que exista la tarea en la base de datos
$sql_search = "SELECT id FROM task WHERE id = :id LIMIT 1;";
$stm_search = $conn->prepare($sql_search);
if (!$stm_search->execute([":id" => $id])) {
    echo "Error al ejecutar el query!";
    die();
}

// Si existe la tarea la actualizo, de lo contrario mando el mensaje al cliente 
if ($stm_search->fetch(PDO::FETCH_ASSOC)) {
    // Actualizo la tarea 
    $sql_update = "UPDATE task SET name = :name AND description = :description WHERE id = :id";
    $stm = $conn->prepare($sql_search);

    // Valido los parametros de la sentencia    
    $stm->bindValue(":id", $id);
    $stm->bindValue(":name", $name);
    $stm->bindValue(":descirption", $description);

    // Ejecuto la sentncia SQL
    $message = !$stm->execute()
        ? "Error al insertar los datos"
        : "Datos actualizados";

    // Mando la respuesta 
    echo $message;
} else {
    echo "No se encontro la tarea";
    die();
}
