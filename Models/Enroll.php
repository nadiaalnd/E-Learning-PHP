<?php
require_once 'Model.php';

class Enroll extends Model
{
    public function getEnroll($column, $value)
    {
        return $this->getBy('enrollments', $column, $value);
    }

    public function getAllEnroll()
    {
        return $this->getAll('enrollments');
    }

    public function addEnroll($data)
    {
        return $this->create('enrollments', $data);
    }

    public function editEnroll($data, $id)
    {
        return $this->update('enrollments', $id, $data);
    }

    public function deleteEnroll($id)
    {
        return $this->delete('enrollments', $id);
    }

    public function getAllEnrollWithMatkulAndMahasiswa()
    {
        $sql = "SELECT enrollments.*, courses.course_name AS matkul, users.name AS mahasiswa FROM enrollments JOIN courses ON enrollments.course_id = courses.id JOIN users ON enrollments.user_id = users.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
