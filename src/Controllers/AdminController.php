<?php
namespace App\Controllers;

class AdminController extends Controller {

    public function __construct() {
        // récupère les donner du manager général et des managers "AuthManager", "TagManager", "ContactManager"
        parent::__construct();
        $this->managerUser = $this->manager('AuthManager');
        $this->managerTag = $this->manager('TagManager');
        $this->managerContact = $this->manager('ContactManager');
    }

    public function index() {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        // utilise les fonctions des manager récupérer plus haut
        $users = $this->managerUser->allUser();
        $tags = $this->managerTag->allTag();
        $contacts = $this->managerContact->allContact();
        // envoie les information des fonction des manager dans la vue Admin/index.php
        // via un tableau associatif
        $this->require("Admin/index.php", ["users" => $users, "tags" => $tags, "contacts" => $contacts]);
    }

}
