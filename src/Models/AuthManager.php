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

    public function findById($value) {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute(array(
            $value
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

    public function allUser() {
        $stmt = $this->bdd->query('SELECT * FROM users');

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Auth");
    }

    public function delete($slug) {
        $stmt = $this->bdd->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute(array(
            $slug
        ));
    }
}
