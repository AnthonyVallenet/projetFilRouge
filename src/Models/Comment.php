<?php
namespace App\Models;
// Défini ce qu'est un commentaire
class Comment {

    private $id;
    private $article_id;
    private $user_id;
    private $content;
    private $editing;
    private $created_at;
    private $first_name;
    private $last_name;

    public function getId() {
        return $this->id;
    }

    public function getArticleId() {
        return $this->article_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getEditing() {
        return $this->editing;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getFirstNameComment() {
        return $this->first_name;
    }

    public function getLastNameComment() {
        return $this->last_name;
    }
}
