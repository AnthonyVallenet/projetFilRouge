<?php
namespace App\Models;

use App\Models\Comment;
/** Class AuthManager **/
class CommentManager extends Manager {

    function __construct()
    {
        parent::__construct();
        $this->class = "App\Models\Auth";
    }

    public function getBdd()
    {
        return $this->bdd;
    }

    public function allComments($slug)
    {
        $stmt = $this->bdd->prepare("SELECT c.*, u.first_name, u.last_name FROM comment c INNER JOIN articles a ON a.id = c.article_id INNER JOIN users u ON u.id = c.user_id WHERE a.id = ? ORDER BY c.created_at DESC;");
        $stmt->execute(array(
            $slug
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Comment");
    }

    public function store($slug) {
        $stmt = $this->bdd->prepare("INSERT INTO comment(article_id, user_id, content) VALUES (?, ?, ?)");
        $stmt->execute(array(
            $slug,
            $_SESSION["user"]["id"],
            $_POST["commentInput"]
        ));
    }

    public function update($slug, $idComment) {
        $stmt = $this->bdd->prepare("UPDATE comment SET content = ?, editing = ? WHERE id = ?");
        $stmt->execute(array(
            $_POST["commentInputEdit-". $idComment],
            date("Y-m-d H:i:s"),
            $idComment
        ));
    }

    public function delete($slug, $idComment) {
        $stmt = $this->bdd->prepare("DELETE FROM comment WHERE id = ?");
        $stmt->execute(array(
            $idComment
        ));
    }

    // SELECT a.id, a.title, t.name FROM articles a INNER JOIN article_tag ac ON a.id = ac.article_id INNER JOIN tag t ON t.id = ac.tag_id GROUP BY a.id;
    // SELECT t.* FROM tag t INNER JOIN article_tag at ON at.tag_id = t.id WHERE at.article_id = "15";
    // SELECT t.id, t.name, t.color FROM tag t INNER JOIN article_tag at on t.id = at.tag_id INNER JOIN articles a on at.article_id = a.id WHERE a.id = "15";
    // SELECT t.*, a.title, a.id FROM tag t INNER JOIN article_tag at ON at.tag_id = t.id INNER JOIN articles a ON a.id = at.article_id GROUP BY a.id;
    // SELECT c.*, u.first_name, u.last_name FROM comment c INNER JOIN articles a ON a.id = c.article_id INNER JOIN users u ON u.id = c.user_id WHERE a.id = 15;
}
