<?php

require_once 'Model.php';

class Assignment extends model
{
    public function getTugas($column, $val)
    {
        return  $this->getBy('assignments', $column, $val);
    }

    public function getAllTugas()
    {
        return $this->getAll('assignments');
    }

    public function addTugas($data)
    {
        return $this->create('assignments', $data);
    }

    public function editTugas($data, $id)
    {
        return $this->update('assignments', $id, $data);
    }

    public function deleteTugas($id)
    {
        return $this->delete('assignments', $id);
    }

    public function getAllTugasWithMatkul($column, $value)
    {
        $sql = "SELECT assignments.*, courses.course_name AS matkul FROM assignments JOIN courses ON assignments.course_id = courses.id" . ($column ? " WHERE $column = ?" : "");
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$value]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
