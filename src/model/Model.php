<?php


namespace App\model;


use App\Database\DB;

class Model
{
    public $db_connection;

    protected $model;

    public $lastId;

    public function __construct()
    {
        $this->db_connection = DB::getInstance()->getConnection();
    }

    /**
     * @param mixed $lastId
     */
    public function setLastId($lastId)
    {
        $this->lastId = $lastId;
    }

    /**
     * @return mixed
     */
    public function getLastId()
    {
        return $this->lastId;
    }

    public function request($sql, $params = [])
    {
        $query = $this->db_connection->prepare($sql);

        try {
            $result = $query->execute($params);
            $this->setLastId($this->db_connection->lastInsertId());
        } catch (\PDOException $exception) {
            $result = $exception->getMessage();
        }

        return $result;
    }

    public function fetch($sql, $params = [], $className = 'stdClass')
    {
        $query = $this->db_connection->prepare($sql);

        try {
            $query->execute($params);
            $result = $query->fetchObject($className);
        } catch (\PDOException $exception) {
            $result = $exception->getMessage();
        }

        return $result;
    }

    public function fetchAll($sql, $params = [], $className = 'stdClass')
    {
        $query = $this->db_connection->prepare($sql);

        try {
            $query->execute($params);
            $result = $query->fetchAll(\PDO::FETCH_CLASS, $className);
        } catch (\PDOException $exception) {
            $result = $exception->getMessage();
        }

        return $result;
    }

}