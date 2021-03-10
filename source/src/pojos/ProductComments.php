<?php

/**
 * Description of ProductComments
 *
 * @author ashan nawarathna
 */
class ProductComments {

    private $id;
    private $comment;
    private $product_obj;
    private $datetime;
    private $user_profile_obj;

    function __construct($id, $comment, $product_obj, $datetime, $user_profile_obj) {
        $this->id = $id;
        $this->comment = $comment;
        $this->product_obj = $product_obj;
        $this->datetime = $datetime;
        $this->user_profile_obj = $user_profile_obj;
    }

    function getId() {
        return $this->id;
    }

    function getComment() {
        return $this->comment;
    }

    function getProduct_obj() {
        return $this->product_obj;
    }

    function getDatetime() {
        return $this->datetime;
    }

    function getUser_profile_obj() {
        return $this->user_profile_obj;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setComment($comment) {
        $this->comment = $comment;
    }

    function setProduct_obj($product_obj) {
        $this->product_obj = $product_obj;
    }

    function setDatetime($datetime) {
        $this->datetime = $datetime;
    }

    function setUser_profile_obj($user_profile_obj) {
        $this->user_profile_obj = $user_profile_obj;
    }

}
