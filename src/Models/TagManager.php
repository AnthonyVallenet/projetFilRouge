<?php
namespace App\Models;

use App\Models\Tag;

class TagManager extends Manager {

    function __construct()
    {
        parent::__construct();
        $this->class = "App\Models\Article";
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
}
