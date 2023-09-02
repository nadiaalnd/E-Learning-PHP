<?php

require_once 'Model.php';

class Matkul extends Model
{
    public function getMatkul($column, $value)
    {
        return $this->getBy('courses', $column, $value);
    }

    public function getAllMatkul()
    {
        return $this->getAll('courses');
    }

    public function addMatkul($data)
    {
        return $this->create('courses', $data);
    }

    public function editMatkul($data, $id)
    {
        return $this->update('courses', $id, $data);
    }

    public function deleteMatkul($id)
    {
        return $this->delete('courses', $id);
    }

    public function getAllMatkulWithDosen()
    {
        $sql = "SELECT courses.*, users.name AS dosen FROM courses JOIN users ON courses.instructor_id = users.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatkulWhere($column, $value)
    {
        $sql = "SELECT courses.*, users.name AS dosen FROM courses JOIN users ON courses.instructor_id = users.id WHERE $column = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$value]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatkulByEnroll($id)
    {
        $sql = "SELECT courses.*, users.name AS dosen FROM courses JOIN users ON courses.instructor_id = users.id WHERE courses.id IN (SELECT course_id FROM enrollments WHERE user_id = ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
