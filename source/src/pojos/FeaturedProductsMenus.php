<?php

/**
 * Description of FeaturedProductsMenus
 *
 * @author ashan nawarathna
 */
class FeaturedProductsMenus {

    private $id;
    private $name;
    private $description;

    function __construct($id, $name, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

}
