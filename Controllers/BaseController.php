<?php

class BaseController
{
    protected $model;

    public function __construct()
    {
        require_once BASE_PATH . 'Helpers/General.php';
    }

    public function loadModel($model)
    {
        $modelPath = 'Models/' . $model . '.php';

        if (file_exists($modelPath)) {
            require $modelPath;
            $modelName = $model;
            $this->model = new $modelName();
        } else {
            echo 'Model not found';
        }
    }

    public function isAuth()
    {
        return session()->has('user');
    }

    public function redirect($url)
    {
        header('location: ' . $url);
    }

    public function req_post($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function req_get($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public function req_file($key)
    {
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }

    public function req_session($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function req_cookie($key)
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    public function req_server($key)
    {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
    }
}
