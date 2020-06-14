<?php

namespace App\Controllers;

use App\Models\UserManager;

/** Class UserController **/
class AuthController extends Controller {

    public function __construct() {
        // récupère les donner du manager général et du managers "AuthManager"
        parent::__construct();
        $this->manager = $this->manager('AuthManager');
    }
// Affiche la vue login
    public function showLogin() {
        $this->require("Auth/login.php", "");
    }
// Affiche la vue register
    public function showRegister() {
        $this->require("Auth/register.php", "");
    }
// se deconnecter
    public function logout()
    {
        session_start();
        session_destroy();
        $this->redirect("");
    }
// enregistre en bdd le nouveau compte
    public function register() {
        // défini les règles de validation de chaque champs du formulaire
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
// verifie si les valeur remplie dans la vu login son bonne pour pouvoir se connecter
    public function login() {
        // défini les règles de validation de chaque champs du formulaire
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
// met a jours un compte via la page admin
    public function update($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
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
                // redirige sur la page admin section user avec les infos modifier
                $this->redirect("administration#users");
            }
        } else {
            // redirige sur la page admin section user avec les infos non modifier et met les msg d'erreur et les ancienne valeurs
            $this->redirect("administration#users");
            die;
        }
    }
// créer un user via la page admin
    public function createUser() {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
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
                // redirige sur la page admin section user avec les infos modifier
                $this->redirect("administration#users");
            } else {
                $_SESSION["error"]['email'] = "L'email choisi est déjà utilisé !";
                $this->redirect("administration#createUser");
            }
        } else {
            // redirige sur la page admin section user avec les infos non modifier et met les msg d'erreur et les ancienne valeurs
            $this->redirect("administration#createUser");
        }
    }
// supprime de la bdd
    public function delete($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $this->manager->delete($slug);
        
        $this->redirect("administration#users");
    }
}
