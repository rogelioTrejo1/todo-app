<?php

namespace models;

use config\DataBase;
use Error;

class Task
{
    public static function getAll(): array
    {
        // Genero la conexion
        $conn = new DataBase();

        // Genero la sentencia SQL y la ejecuto
        $sql = "SELECT * FROM task;";
        $stmt = $conn->getConn()->prepare($sql);

        // Valido que la sentencia se ejecute correctamente
        if (!$stmt->execute())
            throw new Error('Error al ejecutar la sentencia');

        // Genero el json de los datos
        $task = [];
        while ($row = $stmt->fetch(DataBase::FETCH_ASSOC))
            $task[] = [
                "id" => $row['id'],
                "title" => $row['name'],
                "description" => $row['description'],
                "done" => $row['done'] == 1 ? true : false
            ];


        return $task;
    }

    public static function getOne(int $id): array
    {
        // Genero la conexion
        $conn = new DataBase();

        // Genero la sentencia SQL y la ejecuto
        $sql = "SELECT * FROM task WHERE id = :id LIMIT 1;";
        $stmt = $conn->getConn()->prepare($sql);

        // Realizo el intercambio de valores para evitar SQL Injection
        $stmt->bindValue(':id', $id);

        // Valido que la sentencia se ejecute correctamente
        if (!$stmt->execute())
            throw new Error('Error al ejecutar la sentencia');

        // Genero el json de los datos
        $task = [];
        while ($row = $stmt->fetch(DataBase::FETCH_ASSOC))
            $task = [
                "id" => $row['id'],
                "title" => $row['name'],
                "description" => $row['description'],
                "done" => $row['done'] == 1 ? true : false
            ];


        return $task;
    }

    public static function create(array $task)
    {
        // Genero la conexion
        $conn = new DataBase();

        // Genero la sentencia SQL y la ejecuto
        $sql = "INSERT INTO task (id, name, description) VALUES (:id, :name, :description);";
        $stmt = $conn->getConn()->prepare($sql);

        // Realizo el intercambio de valores para evitar SQL Injection
        $stmt->bindValue(':id', $task['id']);
        $stmt->bindValue(':name', $task['title']);
        $stmt->bindValue(':description', $task['description']);

        // Valido que la sentencia se ejecute correctamente
        if (!$stmt->execute())
            throw new Error('Error al ejecutar la sentencia');

        // Genero el json de los datos
        $task_response = [];
        if ($row = $stmt->fetch(DataBase::FETCH_ASSOC))
            $task_response = $row;

        return $task_response;
    }

    public static function update(int $id, array $task)
    {
        // Genero la conexion
        $conn = new DataBase();

        // Genero la sentencia SQL y la ejecuto
        $sql = "UPDATE task SET name = :name, description = :description WHERE id = :id;";
        $stmt = $conn->getConn()->prepare($sql);

        // Realizo el intercambio de valores para evitar SQL Injection
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $task['title']);
        $stmt->bindValue(':description', $task['description']);

        // Valido que la sentencia se ejecute correctamente
        if (!$stmt->execute())
            throw new Error('Error al ejecutar la sentencia');

        // Genero el json de los datos
        $task_response = [];
        if ($row = $stmt->fetch(DataBase::FETCH_ASSOC))
            $task_response = $row;

        return $task_response;
    }

    public static function delete(int $id)
    {
        // Genero la conexion
        $conn = new DataBase();

        // Genero la sentencia SQL y la ejecuto
        $sql = "DELETE FROM task WHERE id = :id;";
        $stmt = $conn->getConn()->prepare($sql);

        // Realizo el intercambio de valores para evitar SQL Injection
        $stmt->bindValue(':id', $id);

        // Valido que la sentencia se ejecute correctamente
        if (!$stmt->execute())
            throw new Error('Error al ejecutar la sentencia');

        return true;
    }
}
