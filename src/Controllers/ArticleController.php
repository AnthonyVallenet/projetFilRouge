<?php

namespace App\Controllers;

use App\Models\UserManager;

/** Class ArticleController **/
class ArticleController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('ArticleManager');
        $this->managerTag = $this->manager('TagManager');
        $this->managerComments = $this->manager('CommentManager');
    }

    public function index() {
        $articles = $this->manager->allArticle();
        $this->require("Article/index.php", $articles);
    }

    public function create() {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $tags = $this->managerTag->allTag();
        $this->require("Article/create.php", $tags);
    }

    public function update($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $this->validator->validate([
            "titleEditArticle" => ["required", "min:3"],
            "dateEditArticle" => ["required", "date"],
            "contentEditArticle" => ["all"]
        ]);
        $_SESSION['old'] = $_POST;
        
        $img_type = $_FILES['imgEditArticle']['type'];
        $img_blob = file_get_contents($_FILES['imgEditArticle']['tmp_name']);
        $enabled = $_POST["enabled"];
        $comment = $_POST["comment"];

        if (!$this->validator->errors()) {
            if ($_POST["enabledEditArticle"] == NULL) {
                $enabled = 0;
            } else {
                $enabled = 1;
            }
            if ($_POST["commentEditArticle"] == NULL) {
                $comment = 0;
            } else {
                $comment = 1;
            }

            if (empty($img_blob)) {
                $article = $this->manager->getArticleBy($slug);
                $img_blob = $article->getImgBlob();
                $img_type = $article->getImgType();
            }
            

            $this->manager->update($slug, $img_type, $img_blob, $comment, $enabled);

            $this->redirect("article/$slug");
        } else {
            $this->redirect("article/$slug?edit");
        }
    }

    public function show($slug) {
        $article = $this->manager->getArticleBy($slug);
        $tagsArticle = $this->managerTag->getTagArticle($slug);
        $allTags = $this->managerTag->allTag();
        $allComments = $this->managerComments->allComments($slug);

        $this->require("Article/show.php", ["article" => $article, "tagsArticle" => $tagsArticle, "allTags" => $allTags, "allComments" => $allComments]);
    }

    public function store() {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $this->validator->validate([
            "title" => ["required", "min:3"],
            "date" => ["required", "date"],
            "content" => ["all"]
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
            $idArticle = $this->manager->getBdd()->lastInsertId();
            
            foreach ($_POST['tags'] as $tagId) {
                $this->managerTag->articleTag($tagId, $idArticle);
            }

            $this->redirect("articles");
        } else {
            $this->redirect("article/create");
        }
    }

    public function searching() {
        $_SESSION['old'] = $_POST;

        $articles = $this->manager->searchByTitle();

        if (!$articles) {
            $articles = $this->manager->searchByContent();
            $this->require("Article/search.php", ["articles" => $articles, "search" => $_POST["search"]]);
            die;
        }

        $this->require("Article/search.php", ["articles" => $articles, "search" => $_POST["search"]]);
    }

    public function delete($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $this->manager->delete($slug);
        
        $this->redirect("articles");
    }

}
