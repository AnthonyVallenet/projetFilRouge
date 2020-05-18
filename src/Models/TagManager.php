<?php
namespace App\Models;

use App\Models\Tag;

class TagManager extends Manager {

    function __construct()
    {
        parent::__construct();
    }

    public function getBdd()
    {
        return $this->bdd;
    }

    public function store() {
        $stmt = $this->bdd->prepare("INSERT INTO tag(name, color) VALUES (?, ?)");
        
        $stmt->execute(array(
            $_POST["name"],
            $_POST["color"],
        ));
    }

    public function allTag() {
        $stmt = $this->bdd->query('SELECT * FROM tag');

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Tag");
    }

    public function articleTag($tagId, $idArticle) {
        $stmt = $this->bdd->prepare("INSERT INTO article_tag(tag_id, article_id) VALUES (?, ?)");
        
        $stmt->execute(array(
            $tagId,
            $idArticle,
        ));
    }

    // select tag.name from articles inner join article_tag on article_tag.article_id = articles.id inner join tag on tag.id = article_tag.tag_id where id = '2';
    // SELECT t.name FROM tag t INNER JOIN article_tag at on t.id = at.tag_id INNER JOIN articles a on at.article_id = a.id WHERE a.id = 12;


    public function getTagArticle($slug) {
        $stmt = $this->bdd->prepare("SELECT t.name FROM tag t INNER JOIN article_tag at on t.id = at.tag_id INNER JOIN articles a on at.article_id = a.id WHERE a.id = ?;");
        
        $stmt->execute(array(
            $slug
        ));

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Tag");
    }
}
