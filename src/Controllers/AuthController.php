<?php

namespace App\Controllers;

use App\Models\UserManager;

/** Class UserController **/
class AuthController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('AuthManager');
    }

    public function showRegister() {
        $this->require("Auth/register.php", "");
    }

    public function register() {
        $this->validator->validate([
            "firstName"=>["required", "min:3", "alpha"],
            "lastName"=>["required", "min:3", "alphaDash"],
            "email"=>["required", "email"],
            "password"=>["required", "min:6", "alphaNum", "confirm"],
            "passwordConfirm"=>["required", "min:6", "alphaNum"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->find($_POST["email"]);

            if (empty($res)) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->manager->store($password);

                $_SESSION["user"] = [
                    "id" => $this->manager->getBdd()->lastInsertId(),
                    "firstName" => $_POST["firstName"],
                    "lastName" => $_POST["lastName"],
                    "email" => $_POST["email"],
                    "admin" => 0
                ];
                $this->redirect("");
            } else {
                $_SESSION["error"]['email'] = "L'email choisi est déjà utilisé !";
                $this->redirect("register");
            }
        } else {
            $this->redirect("register");
        }
    }
}
