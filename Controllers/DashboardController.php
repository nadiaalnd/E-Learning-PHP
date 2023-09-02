<?php
require_once 'BaseController.php';


class DashboardController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->isAuth()) {
            $this->redirect('/');
        }
    }
    public function index()
    {
        echo view()->render('main/dashboard', ['name' => session()->get('user')['name']]);
    }
}
