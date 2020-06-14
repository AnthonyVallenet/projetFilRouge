<?php
namespace App\Controllers;

class HomeController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('ArticleManager');

    }

    public function index() {
        $articles = $this->manager->allArticle();
        $this->require("Home/index.php",  $articles);
    }

    public function pageNotFound() {
        $this->require("404.php", "");
    }
}
