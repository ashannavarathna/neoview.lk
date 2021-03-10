<?php

/**
 * Description of user_profile
 *
 * @author ashan nawarathna
 */
class UserProfile {

    private $id;
    private $firstname;
    private $lastname;
    private $nic;
    private $email;
    private $dob;
    private $gender_obj;
    private $profile_created_date;

    // constructor
    function __construct($id, $fname, $lname, $nic, $email, $dob, $gender, $datetime) {
        $this->id = $id;
        $this->firstname = $fname;
        $this->lastname = $lname;
        $this->nic = $nic;
        $this->email = $email;
        $this->dob = $dob;
        $this->gender_obj = $gender;
        $this->profile_created_date = $datetime;
    }

    function getId() {
        return $this->id;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getNic() {
        return $this->nic;
    }

    function getEmail() {
        return $this->email;
    }

    function getDob() {
        return $this->dob;
    }

    function getGender_obj() {
        return $this->gender_obj;
    }

    function getProfile_created_date() {
        return $this->profile_created_date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setNic($nic) {
        $this->nic = $nic;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDob($dob) {
        $this->dob = $dob;
    }

    function setGender_obj($gender_obj) {
        $this->gender_obj = $gender_obj;
    }

    function setProfile_created_date($profile_created_date) {
        $this->profile_created_date = $profile_created_date;
    }

}

?>