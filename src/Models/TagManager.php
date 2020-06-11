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
        // VALUES (?, ?)
        // INSERT IGNORE INTO article_tag(tag_id, article_id) SELECT tag_id, article_id FROM article_tag WHERE NOT EXISTS (SELECT 1 FROM article_tag WHERE tag_id = ? AND article_id = ?)
        // INSERT INTO article_tag(tag_id, article_id) SELECT tag_id, article_id FROM article_tag WHERE NOT EXISTS (SELECT 1 FROM article_tag WHERE tag_id = ? AND article_id = ?)
        
        $stmt = $this->bdd->prepare("INSERT INTO article_tag(tag_id, article_id) VALUES (?, ?)");
        
        $stmt->execute(array(
            $tagId,
            $idArticle,
        ));
    }

    public function getTagArticle($slug) {
        $stmt = $this->bdd->prepare("SELECT t.id, t.name, t.color FROM tag t INNER JOIN article_tag at on t.id = at.tag_id INNER JOIN articles a on at.article_id = a.id WHERE a.id = ?;");
        
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

    public function delete($slug) {
        $stmt = $this->bdd->prepare("DELETE FROM tag WHERE id = ?");
        $stmt->execute(array(
            $slug
        ));
    }
}
