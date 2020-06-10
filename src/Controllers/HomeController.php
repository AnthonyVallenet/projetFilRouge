<?php
namespace App\Controllers;

class HomeController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->require("Home/index.php", "");
    }

    public function pageNotFound() {
        $this->require("404.php", "");
    }
}
