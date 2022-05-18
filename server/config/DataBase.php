<?php

namespace config;

use PDO;
use PDOException;
use config\Keys;

class DataBase
{
    const FETCH_ASSOC = PDO::FETCH_ASSOC;
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO(
                'mysql:host=' . Keys::getKey('DB_HOST') . ';dbname=' . Keys::getKey('DB_NAME'),
                Keys::getKey('DB_USER'),
                Keys::getKey('DB_PASS')
            );
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            die();
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    public function getConn()
    {
        return $this->conn;
    }
}
