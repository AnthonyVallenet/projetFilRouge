<?php
namespace App\Controllers;

class CommentController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('CommentManager');
    }

    public function store() {
        if (!isset($_SESSION["user"])) {
            $this->redirect("error/404");
            die;
        }
        $this->validator->validate([
            "comment" => ["required", "min:2"],
        ]);
        $_SESSION['old'] = $_POST;

        // SELECT a.id, a.title, t.name FROM articles a INNER JOIN article_tag ac ON a.id = ac.article_id INNER JOIN tag t ON t.id = ac.tag_id GROUP BY a.id;
        // SELECT t.* FROM tag t INNER JOIN article_tag at ON at.tag_id = t.id WHERE at.article_id = "15";
        // SELECT t.id, t.name, t.color FROM tag t INNER JOIN article_tag at on t.id = at.tag_id INNER JOIN articles a on at.article_id = a.id WHERE a.id = "15";
        // SELECT t.*, a.title, a.id FROM tag t INNER JOIN article_tag at ON at.tag_id = t.id INNER JOIN articles a ON a.id = at.article_id GROUP BY a.id;
        // SELECT c.*, u.first_name, u.last_name FROM comment c INNER JOIN articles a ON a.id = c.article_id INNER JOIN users u ON u.id = c.user_id WHERE a.id = 15;
        
        if (!$this->validator->errors()) {
            $this->manager->store();

            $this->redirect("articles");
        } else {
            $this->redirect("article/create");
        }
    }

}
