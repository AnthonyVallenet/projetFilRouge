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

    public function store() {
        $stmt = $this->bdd->prepare("INSERT INTO contact(first_name, last_name, email, sujet, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array(
            $_POST["firstName"],
            $_POST["lastName"],
            $_POST["email"],
            $_POST["sujet"],
            $_POST["message"]
        ));
    }

    public function allContact() {
        $stmt = $this->bdd->query('SELECT * FROM contact');
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Contact");
    }
}
