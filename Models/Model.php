<?php
require_once 'Config/database.php';
class Model
{
    protected $db;

    public function __construct()
    {
        $data = require 'Config/database.php';
        $this->db = new PDO('mysql:host=' . $data['host'] . ';dbname=' . $data['database'], $data['username'], $data['password']);
    }

    public function create($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));

        return $stmt->rowCount();
    }

    public function read($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $id, $data)
    {
        $columns = array_keys($data);
        $placeholders = array_map(function ($column) {
            return $column . ' = ?';
        }, $columns);

        $sql = "UPDATE $table SET " . implode(', ', $placeholders) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_merge(array_values($data), [$id]));

        return $stmt->rowCount();
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount();
    }

    public function getBy($table, $column, $value)
    {
        $sql = "SELECT * FROM $table WHERE $column = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$value]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function innerJoin($table1, $table2, $column1, $column2, $value = null)
    {
        $sql = "SELECT * FROM $table1 INNER JOIN $table2 ON $table1.$column1 = $table2.$column2";
        if ($value != null) {
            $sql .= " WHERE $table1.$column1 = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$value]);
        } else {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
