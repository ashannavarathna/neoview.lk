<?php

/**
 * Description of ProductSubCategory
 *
 * @author ashan nawarathna
 */
class ProductSubCategory {

    private $id;
    private $code;
    private $name;
    private $product_category_obj;

    function __construct($id, $code, $name, $product_category_obj) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->product_category_obj = $product_category_obj;
    }

    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getName() {
        return $this->name;
    }

    function getProduct_category_obj() {
        return $this->product_category_obj;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setProduct_category_obj($product_category_obj) {
        $this->product_category_obj = $product_category_obj;
    }

}
