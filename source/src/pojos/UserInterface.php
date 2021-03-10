<?php

/**
 * Description of UserInterface
 *
 * @author ashan nawarathna
 */
class UserInterface {

    private $id;
    private $name;
    private $status;
    private $inf_code;
    private $url;

    function __construct($id, $name, $status, $inf_code, $url) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->inf_code = $inf_code;
        $this->url = $url;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getStatus() {
        return $this->status;
    }

    function getInf_code() {
        return $this->inf_code;
    }

    function getUrl() {
        return $this->url;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setInf_code($inf_code) {
        $this->inf_code = $inf_code;
    }

    function setUrl($url) {
        $this->url = $url;
    }

}

?>