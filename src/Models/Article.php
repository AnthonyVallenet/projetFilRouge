<?php
namespace App\Models;
// Défini ce qu'est un article
class Article {

    private $id;
    private $title;
    private $date;
    private $img_type;
    private $img_blob;
    private $content;
    private $comment;
    private $enabled;
    private $created_at;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDate() {
        return $this->date;
    }

    public function getImgType() {
        return $this->img_type;
    }

    public function getImgBlob() {
        return $this->img_blob;
    }

    public function getContent() {
        return $this->content;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getEnabled() {
        return $this->enabled;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }


    public function setId(Int $id) {
        $this->id = $id;
    }

    public function setTitle(String $title) {
        $this->title = $title;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setImgType($img_type) {
        $this->img_type = $img_type;
    }

    public function setImgBlob($img_blob) {
        $this->img_blob = $img_blob;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }
}
