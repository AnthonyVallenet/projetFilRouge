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

    public function getTagArticle($slug) {
        $stmt = $this->bdd->prepare("SELECT t.* FROM tag t INNER JOIN article_tag at ON at.tag_id = t.id WHERE at.article_id = ?;");
        
        $stmt->execute(array(
            $slug
        ));

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Tag");
    }


    public function findById($value) {
        $stmt = $this->bdd->prepare("SELECT * FROM tag WHERE id = ?");
        $stmt->execute(array(
            $value
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"App\Models\Tag");

        return $stmt->fetch();
    }

    public function update($slug) {
        $stmt = $this->bdd->prepare("UPDATE tag SET name = ?, color = ? WHERE id = ?");
        $stmt->execute(array(
            $_POST["nameEditTag-". $slug],
            $_POST["colorEditTag-". $slug],
            $slug
        ));
    }

    public function deleteArticleTag($idArticle) {
        $stmt = $this->bdd->prepare("DELETE FROM article_tag WHERE article_id = ?");
        $stmt->execute(array(
            $idArticle,
        ));
    }

    public function delete($slug) {
        $stmt = $this->bdd->prepare("DELETE FROM tag WHERE id = ?");
        $stmt->execute(array(
            $slug
        ));
    }
}
