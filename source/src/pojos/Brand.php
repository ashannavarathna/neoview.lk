<?php

/**
 * Description of Brand
 *
 * @author ashan nawarathna
 */
class Brand {

    private $id;
    private $code;
    private $name;
    private $description;

    function __construct($id, $code, $name, $description) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
    }

    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

}

?>