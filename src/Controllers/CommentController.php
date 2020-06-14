<?php
namespace App\Controllers;

class CommentController extends Controller {

    public function __construct() {
        // récupère les donner du manager général et du managers "CommentManager"
        parent::__construct();
        $this->manager = $this->manager('CommentManager');
    }
// enregistre en bdd le commentaire
    public function store($slug) {
        if (!isset($_SESSION["user"])) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
        $this->validator->validate([
            "commentInput" => ["required", "min:2"],
        ]);
        $_SESSION['old'] = $_POST;
        
        if (!$this->validator->errors()) {
            $this->manager->store($slug);

            $this->redirect("article/". $slug);
        } else {
            $this->redirect("article/". $slug);
        }
    }
// mise a jour du commentaire
    public function update($slug, $idComment) {
        if (!isset($_SESSION["user"])) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
        $this->validator->validate([
            "commentInputEdit-".$idComment => ["required", "min:2"],
        ]);
        $_SESSION['old'] = $_POST;
        
        if (!$this->validator->errors()) {
            $this->manager->update($slug, $idComment);

            $this->redirect("article/". $slug);
        } else {
            $this->redirect("article/". $slug);
        }
    }
// supprime de la bdd
    public function delete($slug, $idComment) {
        if (!isset($_SESSION["user"])) {
            $this->redirect("error/404");
            die;
        }
        $this->manager->delete($slug, $idComment);
        
        $this->redirect("article/". $slug);
    }

}
