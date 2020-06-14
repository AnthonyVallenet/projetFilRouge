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
// fonction pour rediriger utiliser dans les autre controllers
    public function redirect($url)
    {
        header('Location: /' . $url);
        die();
    }
// fontcion pour recupéré une vue utiliser dans les autres controllers
    public function require($path, $info)
    {
        require VIEWS . $path;

    }
// fontion pour récupérer les différents managers utiliser dans les controllers
    public function manager($managers)
    {
        $name = '\App\Models\\' . $managers;
        $managers = new $name();
        return $managers;
    }
}
