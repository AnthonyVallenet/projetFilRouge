<?php
namespace App\Models;
// Défini ce qu'est un contact
class Contact {

    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $subject;
    private $message;
    private $created_at;

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

    public function getSubject() {
        return $this->subject;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getCreatedAt() {
        return $this->created_at;
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

    public function setSubject(String $subject) {
        $this->subject = $subject;
    }

    public function setmessage(Int $message) {
        $this->message = $message;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
    
}
