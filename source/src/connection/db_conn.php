<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db_conn
 *
 * @author ashan nawarathna
 */
class db_conn {

    var $db = "webbased_inventory_system";
//  var $db = "u245635639_mdc";
    var $username = "root";
//  var $username = "u245635639_root";
    var $pass = "mysQl57";
//  var $pass = "Md2COmKG9L1W";

    var $server = "localhost:3307";
    var $pdo_con = "";
    var $pdo_stmt = "";

    function __construct() {

        try {
            @mysql_connect($this->server, $this->username, $this->pass) or die("Server connection unsuccessfull.");
            mysql_select_db($this->db) or die("Database connection unsuccessfull.");

            $this->pdo_con = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db, $this->username, $this->pass);
            // set the PDO error mode to exception
            $this->pdo_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo 'error ' . $ex;
        }
    }

    function query($query) {
        return mysql_query($query);
    }

    function query_n_err($query) {
        return mysql_query($query) or die(mysql_error());
    }

    function pdo_query($query) {
        
    }

    function pdo_prepare($query) {
        $this->pdo_stmt = $this->pdo_con->prepare($query);
    }

    function pdo_bindParam($name, $variable) {
        $this->pdo_stmt->bindParam(':' . $name, $variable);
    }

    function pdo_execute() {
        $this->pdo_stmt->execute();
        return $this->pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function resultRows($result) {
        return mysql_num_rows($result);
    }

    function lastInsertId($table) {
        $results = $this->query("SELECT MAX(id) FROM " . $table);
        return mysql_fetch_row($results);
    }

    function closeConntection() {
        
    }

}

?>