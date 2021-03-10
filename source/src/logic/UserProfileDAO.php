<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserProfileDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserProfile.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserGenderDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class UserProfileDAO {

    public static function save($db, $fname, $lname, $nic, $email, $dob, $idgender, $datetime) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO user_profile (fname,lname,nic,email,dob,gender_idgender,profile_created_date_time) VALUES('{$fname}','{$lname}','{$nic}','{$email}','{$dob}','{$idgender}','{$datetime}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM user_profile WHERE iduser_profile='{$id}'");
    }

    public static function update($db, $id, $fname, $lname, $nic, $email, $dob, $idgender, $datetime) {
        $query = "UPDATE user_profile SET";
        if (!isset($this->$db)) {
            $this->$db = new db_conn();
        }
        if (isset($fname)) {
            $query .= " fname='{$fname}', ";
        }
        if (isset($lname)) {
            $query .= "lname='{$lname}', ";
        }
        if (isset($nic)) {
            $query .= " nic='{$nic}', ";
        }
        if (isset($email)) {
            $query .= " email='{$email}', ";
        }
        if (isset($dob)) {
            $query .= " dob='{$dob}', ";
        }
        if (isset($idgender)) {
            $query .= " gender_idgender='{$idgender}', ";
        }
        if (isset($datetime)) {
            $query .= " profile_created_date_time='{$datetime}', ";
        }

        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $this->$db->query("UPDATE user_profile SET type='{$type}' WHERE iduser_profile='{$id}'");
    }

    public static function getByQuery($db, $condition, $oderby) {
        $query = "SELECT * FROM user_profile ";
        if (isset($db)) {
            $db = new db_conn();
        }
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $gen = UserGenderDAO::getByQuery($db, "idgender='{$row['gender_idgender']}'", null);
            return new UserProfile($row['iduser_profile'], $row['fname'], $row['lname'], $row['nic'], $row['email'], $row['dob'], $gen, $row['profile_created_date_time']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        $query = "SELECT * FROM user_profile ";
        if (isset($db)) {
            $db = new db_conn();
        }
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        if ($row = mysql_fetch_array($result)) {
            $gen = UserGenderDAO::getByQuery($db, "idgender='{$row['gender_idgender']}'", null);
            $dataset = new UserProfile($row['iduser_profile'], $row['fname'], $row['lname'], $row['nic'], $row['email'], $row['dob'], $gen, $row['profile_created_date_time']);
        }
        return $dataset;
    }

}

?>