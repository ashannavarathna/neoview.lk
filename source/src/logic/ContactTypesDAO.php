<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactTypesDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ContactTypes.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class ContactTypesDAO {

    public static function save($db, $name) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO contact_types (name) VALUES('{$name}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM contact_types WHERE idcontact_types='{$id}'");
    }

    public static function update($db, $id, $name) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("UPDATE contact_types SET name='{$name}' WHERE idcontact_types='{$id}'");
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM contact_types ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            return new ContactTypes($row['idcontact_types'], $row['name']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM contact_types ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset;
        if ($row = mysql_fetch_array($result)) {
            $dataset = new ContactTypes($row['idcontact_types'], $row['name']);
        }
        return $dataset;
    }

}

?>