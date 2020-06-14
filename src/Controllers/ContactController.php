<?php

namespace App\Controllers;

class ContactController extends Controller {

    public function __construct() {
        // récupère les donner du manager général et du managers "AuthManager"
        parent::__construct();
        $this->manager = $this->manager('ContactManager');
    }
// affiche la vue contact
    public function index() {
        $this->require("Contact/index.php", "");
    }
// Enregistre le contacte en bdd
    public function store() {
        // défini les règles de validation de chaque champs du formulaire
        $this->validator->validate([
            "firstName"=>["required", "min:3", "max:20", "alpha"],
            "lastName"=>["required", "min:3", "max:20", "alphaDash"],
            "email"=>["required", "email"],
            "subject"=>["required", "min:2", "max:60"],
            "message"=>["required", "min:3"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $this->manager->store();
            // redirige vers la page d'accueil
            $this->redirect("");
        } else {
            // sinon redirige vers la page de création de contact avec les erreurs et les valeurs remplie
            $this->redirect("contact");
        }
    }
// met a jours un contact
    public function update($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        // défini les règles de validation de chaque champs du formulaire
        $this->validator->validate([
            "firstNameEditContact-". $slug =>["required", "min:3", "alpha"],
            "lastNameEditContact-". $slug =>["required", "min:3", "alphaDash"],
            "emailEditContact-". $slug =>["required", "email"],
            "subjectEditContact-". $slug =>["required", "min:2"],
            "messageEditContact-". $slug =>["required", "min:3"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->findById($slug);

            if (empty($res)) {
                $_SESSION["error"]['messageErrorEditContact-'. $slug] = "Ce contact est introuvable !";
                $this->redirect("administration#contacts");
            } else {
                $this->manager->update($slug);
            // redirige vers la page admin section contacte
                $this->redirect("administration#contacts");
            }
        } else {
            // sinon redirige vers la page de mise a jours de contact avec les erreurs et les valeurs remplie
            $this->redirect("administration#contacts");
            die;
        }
    }
// supprime de la bdd
    public function delete($slug) {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] != 1) {
            $this->redirect("error/404");
            die;
        }
        $this->manager->delete($slug);
        
        $this->redirect("administration#contacts");
    }
}
