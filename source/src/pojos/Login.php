<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author ashan nawarathna
 */
class Login {
    private $id;
    private $login_time;
    private $logout_time;
    private $is_logged;
    private $session_id;
    private $cookie_id;
    private $user_account_obj;
    private $ip;
    private $device_info;
    
    function __construct($id, $login_time, $logout_time, $is_logged, $session_id, $cookie_id, $user_account_obj, $ip, $device_info) {
        $this->id = $id;
        $this->login_time = $login_time;
        $this->logout_time = $logout_time;
        $this->is_logged = $is_logged;
        $this->session_id = $session_id;
        $this->cookie_id = $cookie_id;
        $this->user_account_obj = $user_account_obj;
        $this->ip = $ip;
        $this->device_info = $device_info;
    }
    
    function getId() {
        return $this->id;
    }

    function getLogin_time() {
        return $this->login_time;
    }

    function getLogout_time() {
        return $this->logout_time;
    }

    function getIs_logged() {
        return $this->is_logged;
    }

    function getSession_id() {
        return $this->session_id;
    }

    function getCookie_id() {
        return $this->cookie_id;
    }

    function getUser_account_obj() {
        return $this->user_account_obj;
    }

    function getIp() {
        return $this->ip;
    }

    function getDevice_info() {
        return $this->device_info;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin_time($login_time) {
        $this->login_time = $login_time;
    }

    function setLogout_time($logout_time) {
        $this->logout_time = $logout_time;
    }

    function setIs_logged($is_logged) {
        $this->is_logged = $is_logged;
    }

    function setSession_id($session_id) {
        $this->session_id = $session_id;
    }

    function setCookie_id($cookie_id) {
        $this->cookie_id = $cookie_id;
    }

    function setUser_account_obj($user_account_obj) {
        $this->user_account_obj = $user_account_obj;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setDevice_info($device_info) {
        $this->device_info = $device_info;
    }



}
?>