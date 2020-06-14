<?php
namespace App\Models;

use App\Models\Contact;
/** Class ContactManager **/
class ContactManager extends Manager {

    function __construct()
    {
        // récupère les infos du manager générale
        parent::__construct();
        $this->class = "App\Models\Contact";
    }
// permet de récupérer la bdd dans l'appelle des autres fonctions
    public function getBdd()
    {
        return $this->bdd;
    }
// récupère tout les contact
    public function allContact() {
        $stmt = $this->bdd->query('SELECT * FROM contact');
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Contact");
    }
// enregistre en bdd un contact
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
// récupère un contact en fonction de son ID
    public function findById($value) {
        $stmt = $this->bdd->prepare("SELECT * FROM contact WHERE id = ?");
        $stmt->execute(array(
            $value
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"App\Models\Contact");

        return $stmt->fetch();
    }
// met a jour un contact en fonction de son ID
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
// supprime de la bdd
    public function delete($slug) {
        $stmt = $this->bdd->prepare("DELETE FROM contact WHERE id = ?");
        $stmt->execute(array(
            $slug
        ));
    }
}
