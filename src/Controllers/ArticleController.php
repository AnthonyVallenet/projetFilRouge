<?php

namespace App\Controllers;

use App\Models\UserManager;

/** Class ArticleController **/
class ArticleController extends Controller {

    public function __construct() {
        // récupère les donner du manager général et des managers "ArticleManager", "TagManager", "CommentManager"
        parent::__construct();
        $this->manager = $this->manager('ArticleManager');
        $this->managerTag = $this->manager('TagManager');
        $this->managerComments = $this->manager('CommentManager');
    }
// Affiche tout les articles
    public function index() {
        $articles = $this->manager->allArticle();
        $tags = $this->managerTag->allTag();
        $this->require("Article/index.php", ["articles" => $articles, "tags" => $tags]);
    }
// revoie la vue pour créé un article (si pas admin = page 404)
    public function create() {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $tags = $this->managerTag->allTag();
        $this->require("Article/create.php", $tags);
    }
// renvoie la vue qui correspond a 1 article (show)
    public function show($slug) {
        $article = $this->manager->getArticleBy($slug);
        $tagsArticle = $this->managerTag->getTagArticle($slug);
        $allTags = $this->managerTag->allTag();
        $allComments = $this->managerComments->allComments($slug);

        if ($article->getEnabled() == "1" && $_SESSION["user"]["admin"] != 1) {
            $this->redirect("articles");
        }

        $this->require("Article/show.php", ["article" => $article, "tagsArticle" => $tagsArticle, "allTags" => $allTags, "allComments" => $allComments]);
    }
// enregistre en bdd l'article créé
    public function store() {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
        $this->validator->validate([
            "title" => ["required", "min:3", "max:20"],
            "date" => ["required", "date"],
            "content" => ["all", "min:3"]
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
            // envoie en bdd les infos
            $this->manager->store($img_type, $img_blob, $comment, $enabled);
            $idArticle = $this->manager->getBdd()->lastInsertId();
            // envoie en bdd les tags
            foreach ($_POST['tags'] as $tagId) {
                $this->managerTag->articleTag($tagId, $idArticle);
            }
            // redirige vers la page de tout les articles
            $this->redirect("articles");
        } else {
            // si erreur renvoie vers la page de création d'article avec les valeurs remplie et des msg d'erreur
            $this->redirect("article/create");
        }
    }
// mise a jour d'un article
    public function update($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
        $this->validator->validate([
            "titleEditArticle" => ["required", "min:3", "max:20"],
            "dateEditArticle" => ["required", "date"],
            "contentEditArticle" => ["all", "min:3"]
        ]);
        $_SESSION['old'] = $_POST;
        
        $img_type = $_FILES['imgEditArticle']['type'];
        $img_blob = file_get_contents($_FILES['imgEditArticle']['tmp_name']);
        $enabled = $_POST["enabledEditArticle"];
        $comment = $_POST["commentEditArticle"];

        if (!$this->validator->errors()) {
            unset($_SESSION['old']);
            if ($_POST["enabledEditArticle"] != "on") {
                $enabled = 0;
            } else {
                $enabled = 1;
            }
            if ($_POST["commentEditArticle"] != "on") {
                $comment = 0;
            } else {
                $comment = 1;
            }

            if (empty($img_blob)) {
                $article = $this->manager->getArticleBy($slug);
                $img_blob = $article->getImgBlob();
                $img_type = $article->getImgType();
            }
            // envoie en bdd les infos mise a jours
            $this->manager->update($slug, $img_type, $img_blob, $comment, $enabled);
            // envoie en bdd les tags mis a jours
            $this->managerTag->deleteArticleTag($slug);
            foreach ($_POST['tags'] as $tagId) {
                $this->managerTag->articleTag($tagId, $slug);
            }
            // redirige vers la page de l'article (show)
            $this->redirect("article/$slug");
        } else {
            // si erreur renvoie vers la page de modificatio de l'article avec les valeurs remplie et des msg d'erreur
            $this->redirect("article/$slug?edit");
        }
    }
// fonction pour la barre de recherche pour chercher via des mots
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
// fonction pour la barre de recherche pour chercher vie les tags
public function searchByTag($slug) {
        $articles = $this->manager->searchByTag($slug);
        
        $this->require("Article/search.php", ["articles" => $articles, "search" => $slug]);
    }
// supprime de la bdd
    public function delete($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $this->manager->delete($slug);
        
        $this->redirect("articles");
    }

}
