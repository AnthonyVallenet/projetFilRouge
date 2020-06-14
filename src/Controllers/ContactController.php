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
            "firstName"=>["required", "min:3", "max:20", "alpha"],
            "lastName"=>["required", "min:3", "max:20", "alphaDash"],
            "email"=>["required", "email"],
            "subject"=>["required", "min:2", "max:60"],
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
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
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
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $this->manager->delete($slug);
        
        $this->redirect("administration#contacts");
    }
}
