<?php
namespace App\Models;

class TagArticle {

    private $id;
    private $id_tag;
    private $id_article;

    public function getId() {
        return $this->id;
    }

    public function getIdTag() {
        return $this->color;
    }

    public function getIdArticle() {
        return $this->name;
    }

    
    public function setId(Int $id) {
        $this->id = $id;
    }

    public function setIdTag(String $id_tag) {
        $this->id_tag = $id_tag;
    }

    public function setIdArticle($id_article) {
        $this->id_article = $id_article;
    }
}
