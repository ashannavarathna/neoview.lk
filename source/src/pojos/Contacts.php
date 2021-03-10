<?php

/**
 * Description of Contacts
 *
 * @author ashan nawarathna
 */
class Contacts {

    private $id;
    private $number;
    private $contact_types_obj;
    private $is_primary;
    private $user_profile_obj;

    function __construct($id, $number, $contact_types_obj, $is_primary, $user_profile_obj) {
        $this->id = $id;
        $this->number = $number;
        $this->contact_types_obj = $contact_types_obj;
        $this->is_primary = $is_primary;
        $this->user_profile_obj = $user_profile_obj;
    }

    function getId() {
        return $this->id;
    }

    function getNumber() {
        return $this->number;
    }

    function getContact_types_obj() {
        return $this->contact_types_obj;
    }

    function getUser_profile_obj() {
        return $this->user_profile_obj;
    }

    function getIs_primary() {
        return $this->is_primary;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumber($number) {
        $this->number = $number;
    }

    function setContact_types_obj($contact_types_obj) {
        $this->contact_types_obj = $contact_types_obj;
    }

    function setUser_profile_obj($user_profile_obj) {
        $this->user_profile_obj = $user_profile_obj;
    }

    function setIs_primary($is_primary) {
        $this->is_primary = $is_primary;
    }

}
?>