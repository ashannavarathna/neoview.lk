<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasswordResetDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/PasswordReset.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ContactsDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserAccountDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class PasswordResetDAO {

    public static function save($db, $iduser_account, $idcontact, $reset_code, $send_time, $is_reset, $reset_by_email) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO password_reset (user_account_iduser_account, contact_idcounts, reset_code,  send_time, is_reset, reset_by_email) VALUES('{$iduser_account}','{$idcontact}','{$reset_code}','{$send_time}','{$is_reset}','{$reset_by_email}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM password_reset WHERE idpassword_reset='{$id}'");
    }

    public static function update($db, $id, $iduser_account, $idcontact, $reset_code, $send_time, $is_reset, $reset_by_email) {
        $query = "UPDATE password_reset SET";
        if (isset($password)) {
            $query .=" user_account_iduser_account='{$iduser_account}', ";
        }
        if (isset($status)) {
            $query .=" contact_idcontacts='{$idcontact}', ";
        }
        if (isset($reset_code)) {
            $query .= " reset_code='{$reset_code}', ";
        }
        if (isset($send_time)) {
            $query .= " send_time='{$send_time}', ";
        }
        if (isset($is_reset)) {
            $query .= " is_reset='{$is_reset}', ";
        }
        if (isset($reset_by_email)) {
            $query .= " reset_by_email='{$reset_by_email}', ";
        }

        $query .=" WHERE idpassword_reset='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM password_reset ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $useraccount = UserAccountDAO::getByQuery($db, "iduser_account='{$row['user_account_iduser_account']}'", null);
            $contact = ContactsDAO::getByQuery($db, "idcontacts='{$row['contact_idcontacts']}'", null);
            return new PasswordReset($row['idpassword_reset'], $useraccount, $contact, $row['reset_code'], $row['send_time'], $row['is_reset'], $row['reset_by_email']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM password_reset ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array(); // data array
        if ($row = mysql_fetch_array($result)) {
            $useraccount = UserAccountDAO::getByQuery($db, "iduser_account='{$row['user_account_iduser_account']}'", null);
            $contact = ContactsDAO::getByQuery($db, "idcontacts='{$row['contact_idcontacts']}'", null);
            $dataset = new PasswordReset($row['idpassword_reset'], $useraccount, $contact, $row['reset_code'], $row['send_time'], $row['is_reset'], $row['reset_by_email']);
        }
        return $dataset;
    }

}

?>