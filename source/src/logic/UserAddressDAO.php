<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserAddressDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserAddress.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserProfileDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class UserAddressDAO {

    public static function save($db, $no, $ln1, $ln2, $ln3, $ln4, $pscode, $status, $iduser_profile) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO user_address (no,line1,line2,line3,line4,postalcode,status,user_profile_iduser_profile) VALUES('{$no}','{$ln1}','{$ln2}','{$ln3}','{$ln4}','{$pscode}','{$status}','{$iduser_profile}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM user_address WHERE iduser_address='{$id}'");
    }

    public static function update($db, $id, $no, $ln1, $ln2, $ln3, $ln4, $pscode, $status, $iduser_profile) {
        $query = "UPDATE user_address SET";
        if (isset($no)) {
            $query .=" no='{$user_addresstype}' ,";
        }

        if (isset($ln1)) {
            $query .=" ln1='{$ln1}' ,";
        }
        if (isset($ln2)) {
            $query .=" ln2='{$ln2}' ,";
        }
        if (isset($ln3)) {
            $query .=" ln1='{$ln3}' ,";
        }
        if (isset($ln4)) {
            $query .=" ln1='{$ln4}' ,";
        }
        if (isset($status)) {
            $query .=" status='{$status}' ,";
        }
        if (isset($iduser_profile)) {
            $query .=" user_profile_iduser_profile='{$iduser_profile}' ,";
        }

        $query .=" WHERE iduser_address='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_address ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);
        if ($row = mysql_fetch_array($result)) {
            $userprofile = UserProfileDAO::getByQuery($db, " iduser_profile='{$row['user_profile_iduser_profile']}'", null);
            return new UserAddress($row['iduser_address'], $row['no'], $row['line1'], $row['line2'], $row['line3'], $row['4'], $row['postalcode'], $row['status'], $userprofile);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_address ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }


        $result = $db->query($query);
        $dataset = array();
        if ($row = mysql_fetch_array($result)) {
            $userprofile = UserProfileDAO::getByQuery($db, " iduser_profile='{$row['user_profile_iduser_profile']}'", null);
            $dataset = new UserAddress($row['iduser_address'], $row['no'], $row['line1'], $row['line2'], $row['line3'], $line['4'], $row['postalcode'], $row['status'], $userprofile);
        }
        return $dataset;
    }

}

?>