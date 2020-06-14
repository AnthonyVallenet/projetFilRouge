<?php
namespace App\Models;

use App\Models\Article;

class ArticleManager extends Manager {

    function __construct()
    {
        // récupère les infos du manager générale
        parent::__construct();
        $this->class = "App\Models\Article";
    }
// permet de récupérer la bdd dans l'appelle des autres fonctions
    public function getBdd()
    {
        return $this->bdd;
    }
// stock en bdd l'article
    public function store($img_type, $img_blob, $comment, $enabled) {
        $stmt = $this->bdd->prepare("INSERT INTO articles(title, date, img_type, img_blob, content, comment, enabled) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute(array(
            $_POST["title"],
            $_POST["date"],
            $img_type,
            $img_blob,
            $_POST["content"],
            $comment,
            $enabled,
        ));
    }
    // met e jours en bdd l'article
    public function update($slug, $img_type, $img_blob, $comment, $enabled) {
        $stmt = $this->bdd->prepare("UPDATE articles SET title = ?, date = ?, content = ?, img_type = ?, img_blob = ?, enabled = ?, comment = ? WHERE id = ?");
        
        $stmt->execute(array(
            $_POST["titleEditArticle"],
            $_POST["dateEditArticle"],
            $_POST["contentEditArticle"],
            $img_type,
            $img_blob,
            $enabled,
            $comment,
            $slug
        ));
    }
// récupère tout les articles en bdd
    public function allArticle() {
        $stmt = $this->bdd->query('SELECT * FROM articles');
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Article");
    }
// récupère les 3 derniers articles en bdd
    public function limitArticle() {
        $stmt = $this->bdd->query('SELECT * FROM articles LIMIT 3');
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Article");
    }
// récupere l'article en bdd en fonction de son ID
    public function getArticleBy($slug) {
        $stmt = $this->bdd->prepare('SELECT * FROM articles WHERE id = ?');
        $stmt->execute(array(
            $slug
        ));

        $stmt->setFetchMode(\PDO::FETCH_CLASS,"App\Models\Article");
        return $stmt->fetch();
    }

// recherche un article en bdd en fonction de son titre
    public function searchByTitle() {
        $stmt = $this->bdd->prepare('SELECT * FROM articles WHERE title LIKE ?');
        $stmt->execute(array(
            '%' . $_POST["search"] . '%'
        ));
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Article");
    }
// recherche ne bdd un article ne fonction de son contenu
    public function searchByContent() {
        $stmt = $this->bdd->prepare('SELECT * FROM articles WHERE content LIKE ?');
        $stmt->execute(array(
            '%' . $_POST["search"] . '%'
        ));
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Article");
    }
// recherche un article ne bdd en fonction de son tag
    public function searchByTag($slug) {
        $stmt = $this->bdd->prepare('SELECT a.* FROM article_tag ac INNER JOIN articles a ON a.id = ac.article_id INNER JOIN tag t ON t.id = ac.tag_id WHERE t.name = ?');
        $stmt->execute(array(
            $slug
        ));
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Article");
    }
// supprime de la bdd
    public function delete($slug) {
        $stmt = $this->bdd->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->execute(array(
            $slug,
        ));
    }
}
