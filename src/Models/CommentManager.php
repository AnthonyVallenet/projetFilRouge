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
        $stmt = $this->bdd->prepare("SELECT c.*, u.first_name, u.last_name FROM comment c INNER JOIN articles a ON a.id = c.article_id INNER JOIN users u ON u.id = c.user_id WHERE a.id = ?;");
        
        $stmt->execute(array(
            $slug
        ));

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Comment");
    }

    public function store($slug) {
        // $stmt = $this->bdd->prepare("INSERT INTO comment(article_id, user_id, email, password) VALUES (?, ?, ?, ?)");
        // $stmt->execute(array(
        //     $slug,
        //     $_POST["firstName"],
        //     $_POST["lastName"],
        //     $_POST["email"],
        //     $password
        // ));
    }

}
