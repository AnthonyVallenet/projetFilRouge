<?php

namespace App\Controllers;

use App\Models\UserManager;

/** Class UserController **/
class AuthController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('AuthManager');
    }

    public function showLogin() {
        $this->require("Auth/login.php", "");
    }

    public function showRegister() {
        $this->require("Auth/register.php", "");
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $this->redirect("");
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

    public function login() {
        $this->validator->validate([
            "email"=>["required", "email"],
            "password"=>["required", "min:6", "alphaNum"]
        ]);

        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->find($_POST["email"]);

            if ($res && password_verify($_POST['password'], $res->getPassword())) {
                $_SESSION["user"] = [
                    "id" => $res->getId(),
                    "firstName" => $res->getFirstName(),
                    "lastName" => $res->getLastName(),
                    "email" => $res->getEmail(),
                    "admin" => $res->getAdmin()
                ];
                $this->redirect("");
            } else {
                $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
                $this->redirect("login");
            }
        } else {
            $this->redirect("login");
        }
    }

    public function update($slug) {
        $this->validator->validate([
            "firstNameEditUser-". $slug =>["required", "min:3", "alpha"],
            "lastNameEditUser-". $slug =>["required", "min:3", "alphaDash"],
            "emailEditUser-". $slug =>["required", "email"],
            "roleEditUser-". $slug =>["checkbox"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->findById($slug);

            if (empty($res)) {
                $_SESSION["error"]['messageErrorEditUser-'. $slug] = "Cet utilisateur est introuvable !";
                $this->redirect("administration#users");
            } else {
                if ($_POST["roleEditUser-". $slug] == 'on') {
                    $_POST["roleEditUser-". $slug] = '1';
                } elseif ($_POST["roleEditUser-". $slug] == null) {
                    $_POST["roleEditUser-". $slug] = '0';
                }
                $this->manager->update($slug);

                if ($slug == $_SESSION["user"]["id"]) {
                    $_SESSION["user"] = [
                        "id" => $slug,
                        "firstName" => $_POST["firstNameEditUser-". $slug],
                        "lastName" => $_POST["lastNameEditUser-". $slug],
                        "email" => $_POST["emailEditUser-". $slug],
                        "admin" => $_POST["roleEditUser-". $slug],
                    ];
                }
                $this->redirect("administration#users");
            }
        } else {
            $this->redirect("administration#users");
            die;
        }
    }

    public function createUser() {
        $this->validator->validate([
            "firstName"=>["required", "min:3", "alpha"],
            "lastName"=>["required", "min:3", "alphaDash"],
            "email"=>["required", "email"],
            "password"=>["required", "min:6", "alphaNum", "confirm"],
            "passwordConfirm"=>["required", "min:6", "alphaNum"]
        ]);
        $_SESSION['old'] = $_POST;
        $role = $_POST["roleSelect"];

        if (!$this->validator->errors()) {
            $res = $this->manager->find($_POST["email"]);

            if (empty($res)) {
                if ($_POST["roleSelect"] == NULL) {
                    $role = 0;
                } else {
                    $role = 1;
                }
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->manager->storeUser($password, $role);

                $this->redirect("administration#users");
            } else {
                $_SESSION["error"]['email'] = "L'email choisi est déjà utilisé !";
                $this->redirect("administration#createUser");
            }
        } else {
            $this->redirect("administration#createUser");
        }
    }

    public function delete($slug) {
        $this->manager->delete($slug);
        
        $this->redirect("administration#users");
    }
}
