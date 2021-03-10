<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRole
 *
 * @author ashan nawarathna
 */
class UserRole {

    private $id;
    private $role;
    private $role_order;

    function __construct($id, $role, $role_order) {
        $this->id = $id;
        $this->role = $role;
        $this->role_order = $role_order;
    }

    function getId() {
        return $this->id;
    }

    function getRole() {
        return $this->role;
    }

    function getRole_order() {
        return $this->role_order;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setRole_order($role_order) {
        $this->role_order = $role_order;
    }

}
?>