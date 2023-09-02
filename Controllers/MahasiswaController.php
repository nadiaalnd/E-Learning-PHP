<?php

require_once 'BaseController.php';

class MahasiswaController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $isMahasiswa = session()->get('user')['role'] == 'mahasiswa' && $this->isAuth();
        if (!$isMahasiswa) $this->redirect('/dashboard');
    }
    public function manage_matkul_index()
    {
        $this->loadModel('Matkul');
        $data = $this->model->getMatkulByEnroll(session()->get('user')['id']);
        echo view()->render('main/mahasiswa/manage-matkul', ['data' => $data]);
    }

    public function manage_matkul_materi($id)
    {
        $this->loadModel('Materi');
        $data = $this->model->getMateriWhere('course_id', $id);
        $this->loadModel('Matkul');
        $matkul = $this->model->getMatkul('id', $id);
        $matkul = $matkul['course_name'];
        echo view()->render('main/mahasiswa/manage-materi', ['data' => $data, 'id' => $id, 'matkul' => $matkul]);
    }

    public function manage_matkul_materi_download($path)
    {
        $this->loadModel('Materi');
        $data = $this->model->getMateri('id', $path);
        $path = $data['attachment'];
        fileHandle()->download(BASE_PATH . '/assets/uploads/materi/' . $path);
    }

    public function manage_matkul_tugas($id)
    {
        $this->loadModel('Matkul');
        $matkul = $this->model->getMatkul('id', $id);
        $matkul = $matkul['course_name'];
        $this->loadModel('Tugas');
        $tugas = $this->model->getAllTugasWithSubmission(session()->get('user')['id'], $id);
        echo view()->render('main/mahasiswa/manage-tugas', ['data' => $tugas, 'id' => $id, 'matkul' => $matkul]);
    }

    public function manage_matkul_tugas_download($id)
    {

        $this->loadModel('Tugas');
        $data = $this->model->getTugas('id', $id);
        $path = $data['file'];
        fileHandle()->download(BASE_PATH . '/assets/uploads/tugas/' . $path);
    }

    public function manage_matkul_tugas_submit()
    {

        $data = [
            'user_id' => session()->get('user')['id'],
            'file' => fileHandle()->upload($this->req_file('file'), BASE_PATH . '/assets/uploads/tugas/'),
            'submission_time' => date('Y-m-d H:i:s'),
            'assignment_id' => $this->req_post('tugas'),
        ];
        $this->loadModel('Tugas');
        $this->model->updateOrCreate($data);
        echo "<script>alert('Tugas berhasil dikumpulkan');window.location.href='/mahasiswa/matkul';</script>";
    }
}
