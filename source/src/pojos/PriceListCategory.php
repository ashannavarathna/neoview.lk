<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductListCategory
 *
 * @author ashan nawarathna
 */
class PriceListCategory {

    private $id;
    private $name;
    private $image_name;

    function __construct($id, $name, $image_name) {
        $this->id = $id;
        $this->name = $name;
        $this->image_name = $image_name;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getImage_name() {
        return $this->image_name;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setImage_name($image_name) {
        $this->image_name = $image_name;
    }

}
