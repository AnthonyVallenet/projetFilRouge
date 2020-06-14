<?php
namespace App\Models;

use App\Models\Auth;
/** Class AuthManager **/
class AuthManager extends Manager {

    function __construct()
    {
        // récupère les infos du manager générale
        parent::__construct();
        $this->class = "App\Models\Auth";
    }
// permet de récupérer la bdd dans l'appelle des autres fonctions
    public function getBdd()
    {
        return $this->bdd;
    }
// récupere l'email d'un user en bdd
    public function find($email) {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute(array(
            $email
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"App\Models\Auth");

        return $stmt->fetch();
    }
// récupere un user en fnction de son ID
    public function findById($value) {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute(array(
            $value
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"App\Models\Auth");

        return $stmt->fetch();
    }
// stock en bdd le user
    public function store($password) {
        $stmt = $this->bdd->prepare("INSERT INTO users(first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute(array(
            $_POST["firstName"],
            $_POST["lastName"],
            $_POST["email"],
            $password
        ));
    }
// stock en bdd le user créé par un admin
    public function storeUser($password, $role) {
        $stmt = $this->bdd->prepare("INSERT INTO users(first_name, last_name, email, password, admin) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array(
            $_POST["firstName"],
            $_POST["lastName"],
            $_POST["email"],
            $password,
            $role
        ));
    }
// met a jour en bdd le user
    public function update($slug) {
        $stmt = $this->bdd->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, admin = ? WHERE id = ?");
        $stmt->execute(array(
            $_POST["firstNameEditUser-". $slug],
            $_POST["lastNameEditUser-". $slug],
            $_POST["emailEditUser-". $slug],
            $_POST["roleEditUser-". $slug],
            $slug
        ));
    }
// récupere tout les user
    public function allUser() {
        $stmt = $this->bdd->query('SELECT * FROM users');

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Auth");
    }
// supprime de la bdd
    public function delete($slug) {
        $stmt = $this->bdd->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute(array(
            $slug
        ));
    }
}
