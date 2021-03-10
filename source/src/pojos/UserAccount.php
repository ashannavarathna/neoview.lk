<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserAccount
 *
 * @author ashan nawarathna
 */
class UserAccount {

    private $id;
    private $password;
    private $status;
    private $max_login_attempt;
    private $user_profile_obj;
    private $status_obj;
    private $account_verified;
    private $verified_code;
    private $user_role_obj;

    function __construct($id, $password, $status, $max_login_attempt, $status_obj, $account_verified, $verified_code, $user_profile_obj, $user_role_obj) {
        $this->id = $id;
        $this->password = $password;
        $this->status = $status;
        $this->max_login_attempt = $max_login_attempt;
        $this->user_profile_obj = $user_profile_obj;
        $this->status_obj = $status_obj;
        $this->account_verified = $account_verified;
        $this->verified_code = $verified_code;
        $this->user_role_obj = $user_role_obj;
    }

    function getId() {
        return $this->id;
    }

    function getPassword() {
        return $this->password;
    }

    function getStatus() {
        return $this->status;
    }

    function getMax_login_attempt() {
        return $this->max_login_attempt;
    }

    function getUser_profile_obj() {
        return $this->user_profile_obj;
    }

    function getStatus_obj() {
        return $this->status_obj;
    }

    function getAccount_verified() {
        return $this->account_verified;
    }

    function getVerified_code() {
        return $this->verified_code;
    }

    function getUser_role_obj() {
        return $this->user_role_obj;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setMax_login_attempt($max_login_attempt) {
        $this->max_login_attempt = $max_login_attempt;
    }

    function setUser_profile_obj($user_profile_obj) {
        $this->user_profile_obj = $user_profile_obj;
    }

    function setStatus_obj($status_obj) {
        $this->status_obj = $status_obj;
    }

    function setAccount_verified($account_verified) {
        $this->account_verified = $account_verified;
    }

    function setVerified_code($verified_code) {
        $this->verified_code = $verified_code;
    }

    function setUser_role_obj($user_role_obj) {
        $this->user_role_obj = $user_role_obj;
    }

}
?>