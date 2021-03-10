<?php

/**
 * Description of Offers
 *
 * @author ashan nawarathna
 */
class Offers {

    private $id;
    private $name;
    private $description;
    private $discount_prsnt;
    private $discount_amnt;
    private $startdate;
    private $enddate;

    function __construct($id, $name, $description, $discount_prsnt, $discount_amnt, $startdate, $enddate) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->discount_prsnt = $discount_prsnt;
        $this->discount_amnt = $discount_amnt;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getDiscount_prsnt() {
        return $this->discount_prsnt;
    }

    function getDiscount_amnt() {
        return $this->discount_amnt;
    }

    function getStartdate() {
        return $this->startdate;
    }

    function getEnddate() {
        return $this->enddate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDiscount_prsnt($discount_prsnt) {
        $this->discount_prsnt = $discount_prsnt;
    }

    function setDiscount_amnt($discount_amnt) {
        $this->discount_amnt = $discount_amnt;
    }

    function setStartdate($startdate) {
        $this->startdate = $startdate;
    }

    function setEnddate($enddate) {
        $this->enddate = $enddate;
    }

}

?>