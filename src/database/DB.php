<?php
namespace App\Database;

final class DB
{
    private static $instance = null;

    private $_connection;

    private function __construct()
    {
        $host = '127.0.0.1';
        $db   = 'phonebook';
        $user = 'root';
        $pass = 'pjpekzREDFKF';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->_connection = new \PDO($dsn, $user, $pass);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), (int)$e->getCode());
        }

    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->_connection;
    }
}