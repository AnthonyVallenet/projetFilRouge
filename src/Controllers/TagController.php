<?php
namespace App\Controllers;

class TagController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('TagManager');
    }

    public function store() {
        $this->validator->validate([
            "name"=>["required", "min:2", "max:10"],
            "color"=>["required"],
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $this->manager->store();

            $this->redirect("administration");
        } else {
            $this->redirect("administration");
        }
    }

}
