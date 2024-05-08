<?php

namespace App\models;

use PDO;
use App\App;
use App\db\DB;

abstract class Model
{
    protected $connection;

    public function __construct()
    {
        $this->connection = App::connection();
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->connection->query($sql);

        return $query->fetchAll();
    }

    public function find($params)
    {
        if (!is_array($params)) {
            $params = ['id' => $params];
        }

        $whereClause = "";
        foreach ($params as $key => $value) {
            $whereClause .= "$key = :$key, ";
        }
        $whereClause = rtrim($whereClause, ", ");

        $sql = "SELECT * FROM {$this->table} WHERE {$whereClause}";
        $query = $this->connection->prepare($sql);

        foreach ($params as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        $query->execute();

        return $query->fetchAll();
    }

    public function findOne($params)
    {
        if (!is_array($params)) {
            $params = ['id' => $params];
        }

        $whereClause = "";
        foreach ($params as $key => $value) {
            $whereClause .= "$key = :$key, ";
        }
        $whereClause = rtrim($whereClause, ", ");

        $sql = "SELECT * FROM {$this->table} WHERE {$whereClause} LIMIT 1";
        $query = $this->connection->prepare($sql);

        foreach ($params as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        $query->execute();

        return $query->fetch();
    }

    public function create($data){
        if (!is_array($data) || empty($data)) {
            return false;
        }

        $fields = implode(", ", array_keys($data));
        $quotedValues = array_map(function($value) { return $this->connection->quote($value); }, array_values($data));
        $values = implode(", ", $quotedValues);

        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";
        $query = $this->connection->prepare($sql);

        $query->execute();

        return $this->connection->lastInsertId();
    }

    public function update($id, $data){
        if (!is_array($data) || empty($data)) {
            return false;
        }

        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ", ");

        $sql = "UPDATE {$this->table} SET $setClause WHERE id = :id";

        $query = $this->connection->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        $query->execute();

        return $query->rowCount();
    }

    public function delete($params){
        if ((is_array($params) && empty($params)) || (!is_array($params) && !is_numeric($params) || (is_numeric($params) && (int)$params < 1))) {
            return false;
        }

        if (!is_array($params)) {
            $params = ['id' => $params];
        }

        $whereClause = "";
        foreach ($params as $key => $value) {
            $whereClause .= "$key = :$key AND ";
        }
        $whereClause = rtrim($whereClause, " AND ");

        $sql = "DELETE FROM {$this->table} WHERE {$whereClause}";
        $query = $this->connection->prepare($sql);

        foreach ($params as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        $query->execute();

        return $query->rowCount();
    }
}