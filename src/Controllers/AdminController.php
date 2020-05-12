<?php
namespace App\Controllers;

class AdminController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->managerUser = $this->manager('AuthManager');
        $this->managerTag = $this->manager('TagManager');
        $this->managerContact = $this->manager('ContactManager');
    }

    public function index() {
        $users = $this->managerUser->allUser();
        $tags = $this->managerTag->allTag();
        $contacts = $this->managerContact->allContact();

        $this->require("Admin/index.php", ["users" => $users, "tags" => $tags, "contacts" => $contacts]);
    }

}
