<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Status
 *
 * @author ashan nawarathna
 */
class Status {

    private $id;
    private $status_type;
    private $description;

    function __construct($id, $status_type, $description) {
        $this->id = $id;
        $this->status_type = $status_type;
        $this->description = $description;
    }

    function getId() {
        return $this->id;
    }

    function getStatus_type() {
        return $this->status_type;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setStatus_type($status_type) {
        $this->status_type = $status_type;
    }

    function setDescription($description) {
        $this->description = $description;
    }

}
?>