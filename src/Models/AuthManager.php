<?php
namespace App\Models;

use App\Models\Auth;
/** Class AuthManager **/
class AuthManager extends Manager {

    function __construct()
    {
        parent::__construct();
        $this->class = "App\Models\Auth";
    }

    public function getBdd()
    {
        return $this->bdd;
    }

    public function find($email) {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute(array(
            $email
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"App\Models\Auth");

        return $stmt->fetch();
    }

    public function store($password) {
        $stmt = $this->bdd->prepare("INSERT INTO users(first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute(array(
            $_POST["firstName"],
            $_POST["lastName"],
            $_POST["email"],
            $password
        ));
    }
}
