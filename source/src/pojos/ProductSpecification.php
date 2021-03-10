<?php

/**
 * Description of ProductSpecification
 *
 * @author ashan nawarathna
 */
class ProductSpecification {

    private $id;
    private $imgname1;
    private $imgname2;
    private $imgname3;
    private $long_description;
    private $product_model;
    private $product_features;
    private $released_on;
    private $product_obj;

    function __construct($id, $imgname1, $imgname2, $imgname3, $long_description, $product_model, $product_features, $released_on, $product_obj) {
        $this->id = $id;
        $this->imgname1 = $imgname1;
        $this->imgname2 = $imgname2;
        $this->imgname3 = $imgname3;
        $this->long_description = $long_description;
        $this->product_model = $product_model;
        $this->product_features = $product_features;
        $this->released_on = $released_on;
        $this->product_obj = $product_obj;
    }

    function getId() {
        return $this->id;
    }

    function getImgname1() {
        return $this->imgname1;
    }

    function getImgname2() {
        return $this->imgname2;
    }

    function getImgname3() {
        return $this->imgname3;
    }

    function getLong_description() {
        return $this->long_description;
    }

    function getProduct_model() {
        return $this->product_model;
    }

    function getProduct_features() {
        return $this->product_features;
    }

    function getReleased_on() {
        return $this->released_on;
    }

    function getProduct_obj() {
        return $this->product_obj;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setImgname1($imgname1) {
        $this->imgname1 = $imgname1;
    }

    function setImgname2($imgname2) {
        $this->imgname2 = $imgname2;
    }

    function setImgname3($imgname3) {
        $this->imgname3 = $imgname3;
    }

    function setLong_description($long_description) {
        $this->long_description = $long_description;
    }

    function setProduct_model($product_model) {
        $this->product_model = $product_model;
    }

    function setProduct_features($product_features) {
        $this->product_features = $product_features;
    }

    function setReleased_on($released_on) {
        $this->released_on = $released_on;
    }

    function setProduct_obj($product_obj) {
        $this->product_obj = $product_obj;
    }

}
