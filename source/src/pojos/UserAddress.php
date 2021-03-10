<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserAddress
 *
 * @author ashan nawarathna
 */
class UserAddress {

    private $id;
    private $no;
    private $line1;
    private $line2;
    private $line3;
    private $line4;
    private $postalcode;
    private $status;
    private $user_profile_obj;

    function __construct($id, $no, $line1, $line2, $line3, $line4, $postalcode, $status, $user_profile_obj) {
        $this->id = $id;
        $this->no = $no;
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->line3 = $line3;
        $this->line4 = $line4;
        $this->postalcode = $postalcode;
        $this->status = $status;
        $this->user_profile_obj = $user_profile_obj;
    }

    function getId() {
        return $this->id;
    }

    function getNo() {
        return $this->no;
    }

    function getLine1() {
        return $this->line1;
    }

    function getLine2() {
        return $this->line2;
    }

    function getLine3() {
        return $this->line3;
    }

    function getLine4() {
        return $this->line4;
    }

    function getPostalcode() {
        return $this->postalcode;
    }

    function getStatus() {
        return $this->status;
    }

    function getUser_profile_obj() {
        return $this->user_profile_obj;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNo($no) {
        $this->no = $no;
    }

    function setLine1($line1) {
        $this->line1 = $line1;
    }

    function setLine2($line2) {
        $this->line2 = $line2;
    }

    function setLine3($line3) {
        $this->line3 = $line3;
    }

    function setLine4($line4) {
        $this->line4 = $line4;
    }

    function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setUser_profile_obj($user_profile_obj) {
        $this->user_profile_obj = $user_profile_obj;
    }

}
?>