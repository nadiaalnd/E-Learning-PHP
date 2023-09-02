<?php

require_once 'BaseController.php';

class AdminController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $isAdmin = session()->get('user')['role'] == 'admin' && $this->isAuth();
        if (!$isAdmin) $this->redirect('/dashboard');
    }
    public function index()
    {
        echo view()->render('main/dashboard', ['name' => session()->get('user')['name']]);
    }

    public function manage_user_index()
    {
        $this->loadModel('User');
        $data = $this->model->getAllUser();
        echo view()->render('main/admin/manage-user', ['data' => $data]);
    }

    public function manage_user_add()
    {
        $data = [
            'nrp' => $this->req_post('nrp') ?? null,
            'name' => $this->req_post('name'),
            'email' => $this->req_post('email'),
            'password' => password_hash($this->req_post('password'), PASSWORD_DEFAULT),
            'role' => $this->req_post('role'),
        ];

        $this->loadModel('User');
        $this->model->addUser($data);
        echo "<script>alert('User berhasil ditambahkan');window.location.href='/admin/manage-user';</script>";
    }

    public function manage_user_edit($id)
    {
        $this->loadModel('User');
        $model = $this->model->getUser('id', $id);
        $data = [
            'nrp' => $this->req_post('nrp') ?? null,
            'name' => $this->req_post('name'),
            'email' => $this->req_post('email'),
            'password' => $this->req_post('password') ? password_hash($this->req_post('password'), PASSWORD_DEFAULT) : $model['password'],
            'role' => $this->req_post('role'),
        ];

        $this->model->editUser($data, $id);
        echo "<script>alert('User berhasil ubah');window.location.href='/admin/manage-user';</script>";
    }

    public function manage_user_delete($id)
    {
        $this->loadModel('User');
        $this->model->delete('users', $id);
        echo "<script>alert('User berhasil dihapus');window.location.href='/admin/manage-user';</script>";
    }

    public function manage_matkul_index()
    {
        $data = $this->loadModel('Matkul');
        $data = $this->model->getAllMatkulWithDosen();
        $dosen = $this->loadModel('User');
        $dosen = $this->model->userWhere('role', 'dosen');
        // dd($dosen);
        echo view()->render('main/admin/manage-matkul', ['data' => $data, 'dosen' => $dosen]);
    }

    public function manage_matkul_add()
    {
        $data = [
            'course_name' => $this->req_post('name'),
            'instructor_id' => $this->req_post('dosen'),
            'description' => $this->req_post('description'),
        ];

        $this->loadModel('Matkul');
        $this->model->addMatkul($data);
        echo "<script>alert('Matkul berhasil ditambahkan');window.location.href='/admin/matkul';</script>";
    }

    public function manage_matkul_edit($id)
    {
        $this->loadModel('Matkul');
        $data = [
            'course_name' => $this->req_post('name'),
            'instructor_id' => $this->req_post('dosen'),
            'description' => $this->req_post('description'),
        ];

        $this->model->editMatkul($data, $id);
        echo "<script>alert('Matkul berhasil ubah');window.location.href='/admin/matkul';</script>";
    }

    public function manage_matkul_delete($id)
    {
        $this->loadModel('Matkul');
        $this->model->delete('courses', $id);
        echo "<script>alert('Matkul berhasil dihapus');window.location.href='/admin/matkul';</script>";
    }

    public function manage_enroll_index()
    {
        $this->loadModel('Enroll');
        $data = $this->model->getAllEnrollWithMatkulAndMahasiswa();
        $matkul = $this->loadModel('Matkul');
        $matkul = $this->model->getAllMatkul();
        $mahasiswa = $this->loadModel('User');
        $mahasiswa = $this->model->userWhere('role', 'mahasiswa');
        // dd($data);
        echo view()->render('main/admin/manage-enroll', ['data' => $data, 'course' => $matkul, 'mahasiswa' => $mahasiswa]);
    }


    public function manage_enroll_add()
    {
        $data = [
            'user_id' => $this->req_post('mahasiswa'),
            'course_id' => $this->req_post('matkul'),
        ];

        $this->loadModel('Enroll');
        $this->model->addEnroll($data);
        echo "<script>alert('Enroll berhasil ditambahkan');window.location.href='/admin/enroll';</script>";
    }

    public function manage_enroll_edit($id)
    {
        $this->loadModel('Enroll');
        $data = [
            'user_id' => $this->req_post('mahasiswa'),
            'course_id' => $this->req_post('matkul'),
        ];

        $this->model->editEnroll($data, $id);
        echo "<script>alert('Enroll berhasil ubah');window.location.href='/admin/enroll';</script>";
    }

    public function manage_enroll_delete($id)
    {
        $this->loadModel('Enroll');
        $this->model->delete('enrollments', $id);
        echo "<script>alert('Enroll berhasil dihapus');window.location.href='/admin/enroll';</script>";
    }
}
