<?php
namespace App\Controllers;

class CommentController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('CommentManager');
    }

    public function store($slug) {
        if (!isset($_SESSION["user"])) {
            $this->redirect("error/404");
            die;
        }
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

    public function update($slug, $idComment) {
        if (!isset($_SESSION["user"])) {
            $this->redirect("error/404");
            die;
        }
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

    public function delete($slug, $idComment) {
        if (!isset($_SESSION["user"])) {
            $this->redirect("error/404");
            die;
        }
        $this->manager->delete($slug, $idComment);
        
        $this->redirect("article/". $slug);
    }

}
