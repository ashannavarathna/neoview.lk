<?php

/**
 * Description of Product
 *
 * @author ashan nawarathna
 */
class Product {

    private $id;
    private $code;
    private $name;
    private $porder; // order by
    private $brand_obj;
    private $product_sub_category_obj;
    private $description;
    private $offers_obj;
    private $is_featured;
    private $img_name;
    private $retail_price;
    private $wholesale_price;
    private $dealer_price;
    private $status;
    private $product_type;

    function __construct($id, $code, $name, $porder, $brand_obj, $product_sub_category_obj, $description, $offers_obj, $retail_price, $wholesale_price, $is_featured, $img_name, $dealer_price, $status, $product_type) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->porder = $porder;
        $this->brand_obj = $brand_obj;
        $this->product_sub_category_obj = $product_sub_category_obj;
        $this->description = $description;
        $this->offers_obj = $offers_obj;
        $this->retail_price = $retail_price;
        $this->wholesale_price = $wholesale_price;
        $this->is_featured = $is_featured;
        $this->img_name = $img_name;
        $this->dealer_price = $dealer_price;
        $this->status = $status;
        $this->product_type = $product_type;
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

    function getPorder() {
        return $this->porder;
    }

    function getBrand_obj() {
        return $this->brand_obj;
    }

    function getProduct_sub_category_obj() {
        return $this->product_sub_category_obj;
    }

    function getDescription() {
        return $this->description;
    }

    function getOffers_obj() {
        return $this->offers_obj;
    }

    function getIs_featured() {
        return $this->is_featured;
    }

    function getImg_name() {
        return $this->img_name;
    }

    function getRetail_price() {
        return $this->retail_price;
    }

    function getWholesale_price() {
        return $this->wholesale_price;
    }

    function getDealer_price() {
        return $this->dealer_price;
    }

    function getStatus() {
        return $this->status;
    }

    function getProduct_type() {
        return $this->product_type;
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

    function setPorder($porder) {
        $this->porder = $porder;
    }

    function setBrand_obj($brand_obj) {
        $this->brand_obj = $brand_obj;
    }

    function setProduct_sub_category_obj($product_sub_category_obj) {
        $this->product_sub_category_obj = $product_sub_category_obj;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setOffers_obj($offers_obj) {
        $this->offers_obj = $offers_obj;
    }

    function setPrice($retail_price) {
        $this->retail_price = $retail_price;
    }

    function setDiscount($wholesale_price) {
        $this->wholesale_price = $wholesale_price;
    }

    function setIs_featured($is_featured) {
        $this->is_featured = $is_featured;
    }

    function setImg_name($img_name) {
        $this->img_name = $img_name;
    }

    function setRetail_price($retail_price) {
        $this->retail_price = $retail_price;
    }

    function setWholesale_price($wholesale_price) {
        $this->wholesale_price = $wholesale_price;
    }

    function setDealer_price($dealer_price) {
        $this->dealer_price = $dealer_price;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setProduct_type($product_type) {
        $this->product_type = $product_type;
    }

}

?>