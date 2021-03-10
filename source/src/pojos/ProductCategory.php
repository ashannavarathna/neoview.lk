<?php

/**
 * Description of ProductCategory
 *
 * @author ashan nawarathna
 */
class ProductCategory {

    private $id;
    private $code;
    private $name;

    function __construct($id, $code, $name) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
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

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setName($name) {
        $this->name = $name;
    }

}

?>