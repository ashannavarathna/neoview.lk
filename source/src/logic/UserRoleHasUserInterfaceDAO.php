<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRoleHasUserInterfaceDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserRoleHasUserInterface.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserRoleDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserInterfaceDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class UserRoleHasUserInterfaceDAO {

    public static function save($db, $status, $iduser_interface, $iduser_role) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO user_role_has_user_interface (status,,user_interface_iduser_interfaceuser_role_iduser_role) VALUES('{$status}',,'{$iduser_interface}''{$iduser_role}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM user_role_has_user_interface WHERE iduser_role_has_user_interface='{$id}'");
    }

    public static function update($db, $id, $status, $iduser_role, $iduser_interface) {
        $query = "UPDATE user_role_has_user_interface SET ";
        if (!isset($db)) {
            $db = new db_conn();
        }

        if (isset($status)) {
            $query .= " status='{$status}', ";
        }
        if (isset($iduser_role)) {
            $query .= " user_role_iduser_role='{$iduser_role}', ";
        }
        if (isset($iduser_interface)) {
            $query .= " user_interface_iduser_interface='{$iduser_interface}', ";
        }

        $query .= " WHERE iduser_role_has_user_interface='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_role_has_user_interface ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $userrole = UserRoleDAO::getByQuery($db, " iduser_role='{$row['user_role_iduser_role']}'", null);
            $user_interface = UserInterfaceDAO::getByQuery($db, " iduser_interface='{$row['user_interface_iduser_interface']}'", null);
            return new UserRoleHasUserInterface($row['iduser_role_has_user_interface'], $row['status'], $user_interface, $userrole);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_role_has_user_interface ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }


        $result = $db->query($query);
        $dataset;
        if ($row = mysql_fetch_array($result)) {
            $userrole = UserRoleDAO::getByQuery($db, " iduser_role='{$row['user_role_iduser_role']}'", null);
            $user_interface = UserInterfaceDAO::getByQuery($db, " iduser_interface='{$row['user_interface_iduser_interface']}'", null);
            return new UserRoleHasUserInterface($row['iduser_role_has_user_interface'], $row['status'], $user_interface, $userrole);
        }
        return $dataset;
    }

}
