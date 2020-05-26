<?php

namespace App\Controllers;

class ContactController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('ContactManager');
    }

    public function index() {
        $this->require("Contact/index.php", "");
    }

    public function store() {
        $this->validator->validate([
            "firstName"=>["required", "min:3", "alpha"],
            "lastName"=>["required", "min:3", "alphaDash"],
            "email"=>["required", "email"],
            "subject"=>["required", "min:2"],
            "message"=>["required", "min:3"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $this->manager->store();

            $this->redirect("");
        } else {
            $this->redirect("contact");
        }
    }

    public function update($slug) {
        $this->validator->validate([
            "firstNameEditContact-". $slug =>["required", "min:3", "alpha"],
            "lastNameEditContact-". $slug =>["required", "min:3", "alphaDash"],
            "emailEditContact-". $slug =>["required", "email"],
            "subjectEditContact-". $slug =>["required", "min:2"],
            "messageEditContact-". $slug =>["required", "min:3"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->findById($slug);

            if (empty($res)) {
                $_SESSION["error"]['messageErrorEditContact-'. $slug] = "Ce contact est introuvable !";
                $this->redirect("administration#contacts");
            } else {
                $this->manager->update($slug);

                $this->redirect("administration#contacts");
            }
        } else {
            $this->redirect("administration#contacts");
            die;
        }
    }

    public function delete($slug) {
        $this->manager->delete($slug);
        
        $this->redirect("administration#contacts");
    }
}
