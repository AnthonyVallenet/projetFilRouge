<?php
namespace App\Controllers;

class TagController extends Controller {

    public function __construct() {
        // récupère les donner du manager général et du managers "TagManager"
        parent::__construct();
        $this->manager = $this->manager('TagManager');
    }
// enregistre un tag en bdd
    public function store() {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
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
// met a jours un tag
    public function update($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
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
// supprime de la bdd
    public function delete($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $this->manager->delete($slug);
        
        $this->redirect("administration#tags");
    }

}
