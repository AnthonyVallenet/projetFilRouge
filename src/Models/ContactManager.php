<?php
namespace App\Models;

use App\Models\Contact;
/** Class ContactManager **/
class ContactManager extends Manager {

    function __construct()
    {
        parent::__construct();
        $this->class = "App\Models\Contact";
    }

    public function getBdd()
    {
        return $this->bdd;
    }

    public function allContact() {
        $stmt = $this->bdd->query('SELECT * FROM contact');
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Contact");
    }

    public function store() {
        $stmt = $this->bdd->prepare("INSERT INTO contact(first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array(
            $_POST["firstName"],
            $_POST["lastName"],
            $_POST["email"],
            $_POST["subject"],
            $_POST["message"]
        ));
    }

    public function findById($value) {
        $stmt = $this->bdd->prepare("SELECT * FROM contact WHERE id = ?");
        $stmt->execute(array(
            $value
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"App\Models\Contact");

        return $stmt->fetch();
    }

    public function update($slug) {
        $stmt = $this->bdd->prepare("UPDATE contact SET first_name = ?, last_name = ?, email = ?, subject = ?, message = ? WHERE id = ?");
        $stmt->execute(array(
            $_POST["firstNameEditContact-". $slug],
            $_POST["lastNameEditContact-". $slug],
            $_POST["emailEditContact-". $slug],
            $_POST["subjectEditContact-". $slug],
            $_POST["messageEditContact-". $slug],
            $slug
        ));
    }

    public function delete($slug) {
        $stmt = $this->bdd->prepare("DELETE FROM contact WHERE id = ?");
        $stmt->execute(array(
            $slug
        ));
    }
}
