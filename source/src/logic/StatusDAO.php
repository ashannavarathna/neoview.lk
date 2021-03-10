<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatusDAO
 *
 * @author ashan nawarathna
 */
//Document Root Path
$document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
//online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';
//sub inclued files
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Status.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class StatusDAO {

    public static function save($db, $statustype, $description) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO status (statustype,description) VALUES('{$statustype}','{$description}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM status WHERE idstatus='{$id}'");
    }

    public static function update($db, $id, $statustype, $description) {
        $query = "UPDATE status SET";
        if (isset($statustype)) {
            $query .=" statustype='{$statustype}' ,";
        }

        if (isset($description)) {
            $query .=" description='{$description}' ,";
        }

        $query .=" WHERE idstatus='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM status ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            return new Status($row['idstatus'], $row['statustype'], $row['description']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM status ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        if ($row = mysql_fetch_array($result)) {
            $dataset = new Status($row['idstatus'], $row['statustype'], $row['description']);
        }
        return $dataset;
    }

}

?>