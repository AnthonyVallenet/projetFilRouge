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

    public function update($slug) {
        $this->validator->validate([
            "nameEditTag-". $slug =>["required", "min:2", "max:10"],
            "colorEditTag-". $slug =>["required"],
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->findById($slug);

            if (empty($res)) {
                $_SESSION["error"]['messageErrorEditTag-'. $slug] = "Ce tag est introuvable !";
                $this->redirect("administration#tags");
            } else {
                $this->manager->update($slug);

                $this->redirect("administration#tags");
            }
        } else {
            $this->redirect("administration#tags");
            die;
        }
    }

    public function delete($slug) {
        $this->manager->delete($slug);
        
        $this->redirect("administration#tags");
    }

}
