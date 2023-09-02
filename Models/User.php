<?php

require_once 'Model.php';

class User extends Model
{
    public function getUser($column, $value)
    {
        return $this->getBy('users', $column, $value);
    }

    public function getAllUser()
    {
        return $this->getAll('users');
    }

    public function addUser($data)
    {
        return $this->create('users', $data);
    }

    public function editUser($data, $id)
    {
        return $this->update('users', $id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete('users', $id);
    }

    public function userWhere($column, $value)
    {
        $sql = "SELECT * FROM users WHERE $column = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$value]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
