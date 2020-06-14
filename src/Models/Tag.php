<?php
namespace App\Models;
// Défini ce qu'est un tag
class Tag {

    private $id;
    private $color;
    private $name;

    public function getIdTag() {
        return $this->id;
    }

    public function getColor() {
        return $this->color;
    }

    public function getName() {
        return $this->name;
    }

    
    public function setId(Int $id) {
        $this->id = $id;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
