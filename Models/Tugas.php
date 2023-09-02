<?php
require_once 'Model.php';

class Tugas extends Model
{
    public function getTugas($column, $val)
    {
        return  $this->getBy('submissions', $column, $val);
    }

    public function getAllTugas()
    {
        return $this->getAll('submissions');
    }

    public function addTugas($data)
    {
        return $this->create('submissions', $data);
    }

    public function editTugas($data, $id)
    {
        return $this->update('submissions', $id, $data);
    }

    public function deleteTugas($id)
    {
        return $this->delete('submissions', $id);
    }

    public function getAllTugasWithMatkul()
    {
        $sql = "SELECT submissions.*, courses.course_name AS matkul FROM submissions JOIN courses ON submissions.course_id = courses.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrCreate($data)
    {
        $sql = "SELECT * FROM submissions WHERE user_id = ? AND assignment_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$data['user_id'], $data['assignment_id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $sql = "UPDATE submissions SET file = ?, submission_time = ? WHERE user_id = ? AND assignment_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$data['file'], $data['submission_time'], $data['user_id'], $data['assignment_id']]);
        } else {
            $sql = "INSERT INTO submissions (user_id, file, submission_time, assignment_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$data['user_id'], $data['file'], $data['submission_time'], $data['assignment_id']]);
        }

        return $stmt->rowCount();
    }

    public function getAllTugasWithSubmission($id, $course_id)
    {
        // $sql = "SELECT submissions.*, assignments.assignment_name, assignments.deadline, assignments.id as Assignment_id FROM submissions LEFT JOIN assignments ON submissions.assignment_id = assignments.id WHERE submissions.user_id = ? AND assignments.course_id = ?";

        // $stmt = $this->db->prepare($sql);
        // $stmt->execute([$id, $course_id]);


        // return $stmt->fetchAll(PDO::FETCH_ASSOC);


        $queryGetTugas = "SELECT * FROM assignments WHERE course_id = ?";
        $queryGetStatusTugas = "SELECT * FROM submissions WHERE assignment_id = ? AND user_id = ?";

        // Mengambil data daftar tugas
        $stmtTugas = $this->db->prepare($queryGetTugas);
        $stmtTugas->execute([$course_id]);
        $daftarTugas = $stmtTugas->fetchAll(PDO::FETCH_ASSOC);
        // Mengambil data pengumpulan tugas untuk setiap tugas
        foreach ($daftarTugas as &$tugas) {
            $stmtStatusTugas = $this->db->prepare($queryGetStatusTugas);
            $stmtStatusTugas->execute([$tugas['id'], $id]);
            $statusTugas = $stmtStatusTugas->fetch(PDO::FETCH_ASSOC);
            if ($statusTugas) {
                // Jika pengumpulan ditemukan, tambahkan informasi pengumpulan ke tugas
                $tugas['submission_id'] = $statusTugas['id'];
                $tugas['submission_time'] = $statusTugas['submission_time'];
                $tugas['file'] = $statusTugas['file'];
                $tugas['nilai'] = $statusTugas['nilai'];
            } else {
                // Jika pengumpulan tidak ditemukan, set nilai-nilai pengumpulan ke null
                $tugas['submission_id'] = null;
                $tugas['submission_time'] = null;
                $tugas['file'] = null;
                $tugas['nilai'] = null;
            }
        }

        return $daftarTugas;
    }

    public function dataPengumpulan($id_assignment)
    {
        $sql = "SELECT submissions.*, users.name, users.nrp FROM submissions JOIN users ON submissions.user_id = users.id WHERE assignment_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_assignment]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
