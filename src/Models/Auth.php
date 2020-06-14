<?php
namespace App\Models;
// Défini l'authentification
class Auth {

    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $created_at;
    private $admin;

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getAdmin() {
        return $this->admin;
    }

    
    public function setId(Int $id) {
        $this->id = $id;
    }

    public function setFirstName(String $first_name) {
        $this->first_name = $first_name;
    }

    public function setLastName(String $last_name) {
        $this->last_name = $last_name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword(String $password) {
        $this->password = $password;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function setAdmin(Int $admin) {
        $this->admin = $admin;
    }
}
