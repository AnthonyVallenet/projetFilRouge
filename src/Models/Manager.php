<?php
namespace App\Models;

class Manager
{
    protected $bdd;
    protected $class;

    function __construct()
    {
        $this->bdd = new \PDO('mysql:host=127.0.0.1;dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}
