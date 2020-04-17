<?php
namespace App\Controllers;

use App\Validator;

class Controller
{
    protected $manager;
    protected $validator;

    function __construct()
    {
        $this->validator = new Validator();
    }

    public function redirect($url)
    {
        header('Location: /' . $url);
        die();
    }

    public function require($path, $info)
    {
        require VIEWS . $path;

    }

    public function manager($managers)
    {
        $name = '\App\Models\\' . $managers;
        $managers = new $name();
        return $managers;
    }
}
