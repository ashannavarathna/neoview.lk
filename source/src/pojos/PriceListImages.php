<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductListImages
 *
 * @author ashan nawarathna
 */
class PriceListImages {

    //put your code here

    private $id;
    private $image_name;
    private $price_list_category_obj;

    function __construct($id, $image_name, $price_list_category_obj) {
        $this->id = $id;
        $this->image_name = $image_name;
        $this->price_list_category_obj = $price_list_category_obj;
    }

    function getId() {
        return $this->id;
    }

    function getImage_name() {
        return $this->image_name;
    }

    function getPrice_list_category_obj() {
        return $this->price_list_category_obj;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setImage_name($image_name) {
        $this->image_name = $image_name;
    }

    function setPrice_list_category_obj($price_list_category_obj) {
        $this->price_list_category_obj = $price_list_category_obj;
    }

}
