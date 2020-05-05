<?php
namespace App\Controllers;

class AdminController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->managerUser = $this->manager('AuthManager');
        // $this->managerUser = $this->manager('AuthManager');
        $this->managerContact = $this->manager('ContactManager');
    }

    public function index() {
        $users = $this->managerUser->allUser();
        $contacts = $this->managerContact->allContact();

        $this->require("Admin/index.php", ["users" => $users, "contacts" => $contacts]);
    }

}
