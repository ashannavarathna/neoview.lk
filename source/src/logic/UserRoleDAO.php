<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRoleDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserRole.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class UserRoleDAO {

    public static function save($db, $role, $order) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO user_role (role,role_order) VALUES('{$role}','{$order}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM user_role WHERE iduser_role='{$id}'");
    }

    public static function update($db, $id, $role, $order) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        $query = "UPDATE user_role SET";
        if ($role != null) {
            $query .= " role='{$role}',";
        }
        if ($order != null) {
            $query .= " role_order='{$order}',";
        }


        $query .= " WHERE iduser_role='{$id}'";
        //validate sql query
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_role ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            return new UserRole($row[0], $row[1], $row[2]);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_role ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $dataset = new UserRole($row[0], $row[1], $row[2]);
        }
        return $dataset;
    }

}

?>