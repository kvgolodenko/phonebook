<?php


namespace App\model;


use App\Database\DB;

class Model
{
    public $db_connection;

    protected $model;

    public function __construct()
    {
        $this->db_connection = DB::getInstance()->getConnection();
    }
    public function request($sql, $params = [])
    {
        $query = $this->db_connection->prepare($sql);

        try {
            $result = $query->execute($params);
        } catch (\PDOException $exception) {
            $result = $exception->getMessage();
        }

        return $result;
    }

    public function fetch($sql, $params = [])
    {
        $query = $this->db_connection->prepare($sql);

        try {
            $query->execute($params);
            $result = $query->fetch();
        } catch (\PDOException $exception) {
            $result = $exception->getMessage();
        }
        return $result;
    }

    public function fetchAll($sql, $params = [])
    {
        $query = $this->db_connection->prepare($sql);

        try {
            $query->execute($params);
            $result = $query->fetchAll();
        } catch (\PDOException $exception) {
            $result = $exception->getMessage();
        }
        return $result;
    }

}