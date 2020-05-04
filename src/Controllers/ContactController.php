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
            "sujet"=>["required", "min:2"],
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
}
