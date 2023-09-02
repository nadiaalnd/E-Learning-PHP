<?php
require_once 'Model.php';

class Materi extends Model
{
    public function getMateri($column, $value)
    {
        return $this->getBy('lessons', $column, $value);
    }

    public function getAllMateri()
    {
        return $this->getAll('lessons');
    }

    public function addMateri($data)
    {
        return $this->create('lessons', $data);
    }

    public function editMateri($data, $id)
    {
        return $this->update('lessons', $id, $data);
    }

    public function deleteMateri($id)
    {
        return $this->delete('lessons', $id);
    }

    public function getAllMateriWithMatkul()
    {
        $sql = "SELECT lessons.*, courses.course_name AS matkul FROM lessons JOIN courses ON lessons.course_id = courses.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMateriWhere($column, $value)
    {
        $sql = "SELECT lessons.*, courses.course_name AS matkul FROM lessons JOIN courses ON lessons.course_id = courses.id WHERE $column = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$value]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
