<?php
require_once 'Session.php';


if (!function_exists('session')) {
    function session()
    {
        return new Session();
    }
}

if (!function_exists('view')) {
    function view()
    {
        return new League\Plates\Engine(BASE_PATH . 'Views');
    }
}


if (!function_exists('dd')) {
    function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }
}

if (!function_exists('fileHandle')) {
    function fileHandle()
    {
        require_once BASE_PATH . 'Helpers/FileHandle.php';
        return new FileHandle();
    }
}
