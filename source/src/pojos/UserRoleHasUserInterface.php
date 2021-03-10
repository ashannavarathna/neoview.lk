<?php

/**
 * Description of UserRoleHasUserInterface
 *
 * @author ashan nawarathna
 */
class UserRoleHasUserInterface {

    private $id;
    private $status;
    private $user_interface_obj;
    private $user_role_obj;

    function __construct($id, $status, $user_interface_obj, $user_role_obj) {
        $this->id = $id;
        $this->status = $status;
        $this->user_interface_obj = $user_interface_obj;
        $this->user_role_obj = $user_role_obj;
    }

    function getId() {
        return $this->id;
    }

    function getStatus() {
        return $this->status;
    }

    function getUser_role_obj() {
        return $this->user_role_obj;
    }

    function getUser_interface_obj() {
        return $this->user_interface_obj;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setUser_role_obj($user_role_obj) {
        $this->user_role_obj = $user_role_obj;
    }

    function setUser_interface_obj($user_interface_obj) {
        $this->user_interface_obj = $user_interface_obj;
    }

}

?>