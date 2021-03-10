<?php

/**
 * Description of ProductCommentReplys
 *
 * @author ashan nawarathna
 */

class ProductCommentReplys {

    private $id;
    private $product_comment_obj;
    private $datetime;
    private $user_profile_obj;

    function __construct($id, $product_comment_obj, $datetime, $user_profile_obj) {
        $this->id = $id;
        $this->product_comment_obj = $product_comment_obj;
        $this->datetime = $datetime;
        $this->user_profile_obj = $user_profile_obj;
    }

    function getId() {
        return $this->id;
    }

    function getProduct_comment_obj() {
        return $this->product_comment_obj;
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

    function setProduct_comment_obj($product_comment_obj) {
        $this->product_comment_obj = $product_comment_obj;
    }

    function setDatetime($datetime) {
        $this->datetime = $datetime;
    }

    function setUser_profile_obj($user_profile_obj) {
        $this->user_profile_obj = $user_profile_obj;
    }

}

?>