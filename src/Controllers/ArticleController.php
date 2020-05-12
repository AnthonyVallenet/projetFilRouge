<?php

namespace App\Controllers;

use App\Models\UserManager;

/** Class ArticleController **/
class ArticleController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('ArticleManager');
    }

    public function index() {
        $articles = $this->manager->allArticle();
        $this->require("Article/index.php", $articles);
    }

    public function create() {
        $this->require("Article/create.php", "");
    }

    public function edit($slug) {

    }

    public function show($slug) {

    }

    public function store() {
        $this->validator->validate([
            "title" => ["required", "min:3"],
            "date" => ["required", "date"],
            "content" => ["required"]
        ]);
        $_SESSION['old'] = $_POST;

        $img_type = $_FILES['imgArticle']['type'];
        $img_blob = file_get_contents($_FILES['imgArticle']['tmp_name']);
        $enabled = $_POST["enabled"];
        $comment = $_POST["comment"];

        if (empty($img_blob)) {
            if (!isset($_SESSION["error"]["imgArticle"])) {
                $_SESSION["error"]["imgArticle"] = "L'image est obligatoire !";
            }
            $this->redirect("article/create");
            die;
        }

        if (!$this->validator->errors()) {
            if ($_POST["enabled"] == NULL) {
                $enabled = 0;
            } else {
                $enabled = 1;
            }
            if ($_POST["comment"] == NULL) {
                $comment = 0;
            } else {
                $comment = 1;
            }
            $this->manager->store($img_type, $img_blob, $comment, $enabled);

            $this->redirect("");
        } else {
            $this->redirect("article/create");
        }
    }

    public function searching() {
        $this->validator->validate([
            "search" => ["required", "min:2", "max:40"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $articles = $this->manager->searchByTitle();
            $articles = $this->manager->searchByContent();

            $this->require("Article/search.php", ["articles" => $articles, "search" => $_POST["search"]]);
            
        } else {
            $this->redirect("article/search");
        }
    }

}
