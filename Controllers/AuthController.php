<?php

require_once 'BaseController.php';

class AuthController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        echo view()->render('login');
    }

    public function login()
    {
        $email = $this->req_post('email'); // sama seperti $_POST['email']
        $password = $this->req_post('password');
        require_once BASE_PATH . 'Helpers/General.php';
        $this->loadModel('User');
        $user = $this->model->getUser('email', $email);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                session()->put('user', $user);
                session()->put('role', $user['role']);
                $this->redirect('/dashboard');
            } else {
                session()->put('error', 'Password is incorrect');
                $this->redirect('/');
            }
        }
    }


    public function logout()
    {
        session()->destroy();
        $this->redirect('/');
    }
}
