<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasswordReset
 *
 * @author ashan nawarathna
 */
class PasswordReset {

    private $id;
    private $user_account_obj;
    private $contact_obj;
    private $reset_code;
    private $send_time;
    private $is_reset;
    private $reset_by_email;

    function __construct($id, $user_account_obj, $contact_obj, $reset_code, $send_time, $is_reset, $reset_by_email) {
        $this->id = $id;
        $this->user_account_obj = $user_account_obj;
        $this->contact_obj = $contact_obj;
        $this->reset_code = $reset_code;
        $this->send_time = $send_time;
        $this->is_reset = $is_reset;
        $this->reset_by_email = $reset_by_email;
    }

    function getId() {
        return $this->id;
    }

    function getUser_account_obj() {
        return $this->user_account_obj;
    }

    function getContact_obj() {
        return $this->contact_obj;
    }

    function getReset_code() {
        return $this->reset_code;
    }

    function getSend_time() {
        return $this->send_time;
    }

    function getIs_reset() {
        return $this->is_reset;
    }

    function getReset_by_email() {
        return $this->reset_by_email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser_account_obj($user_account_obj) {
        $this->user_account_obj = $user_account_obj;
    }

    function setContact_obj($contact_obj) {
        $this->contact_obj = $contact_obj;
    }

    function setReset_code($reset_code) {
        $this->reset_code = $reset_code;
    }

    function setSend_time($send_time) {
        $this->send_time = $send_time;
    }

    function setIs_reset($is_reset) {
        $this->is_reset = $is_reset;
    }

    function setReset_by_email($reset_by_email) {
        $this->reset_by_email = $reset_by_email;
    }

}
?>