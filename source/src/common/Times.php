<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Times
 *
 * @author ashan nawarathna
 */
class Times {

    public static function getFullTime() {
        date_default_timezone_set("Asia/Colombo");
        return date("Y-m-d H:i:s");
    }

    public static function getDate() {
        date_default_timezone_set("Asia/Colombo");
        return date("Y-m-d");
    }

    public static function checkDateInrange($startDate, $endDate, $checkDate) {
        $start = strtotime($startDate);
        $end = strtotime($endDate);
        $check = strtotime($checkDate);

        return ( ($check >= $start) && ($end >= $check) );
    }

}
?>