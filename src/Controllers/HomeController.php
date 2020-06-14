<?php
namespace App\Controllers;

class HomeController extends Controller {

    public function __construct() {
        // récupère les donner du manager général et du managers "ArticleManager"
        parent::__construct();
        $this->manager = $this->manager('ArticleManager');

    }
// fonction pour afficher 3 articles dans la page d'accueil
    public function index() {
        $articles = $this->manager->limitArticle();
        $this->require("Home/index.php",  $articles);
    }
// fonction pour afficher la page 404
    public function pageNotFound() {
        $this->require("404.php", "");
    }
}
