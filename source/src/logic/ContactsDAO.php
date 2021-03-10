<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactsDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Contacts.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ContactTypesDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserProfileDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class ContactsDAO {

    public static function save($db, $number, $idcontact_type, $is_primary, $iduser_profile) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO contacts (number,contact_types_idcontact_types,is_primary,user_profile_iduser_profile) VALUES('{$number}','{$idcontact_type}','{$is_primary}','{$iduser_profile}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM contacts WHERE idcontacts='{$id}'");
    }

    public static function update($db, $id, $number, $idcontact_type, $is_primary, $iduser_profile) {
        $query = "UPDATE contacts SET ";
        if (!isset($db)) {
            $db = new db_conn();
        }

        if (isset($number)) {
            $query .= " number='{$number}', ";
        }
        if (isset($idcontact_type)) {
            $query .= " contact_types_idcontact_types='{$idcontact_type}', ";
        }
        if (isset($is_primary)) {
            $query .= " is_primary='{$is_primary}', ";
        }
        if (isset($iduser_profile)) {
            $query .= " user_profile_iduser_profile='{$iduser_profile}', ";
        }

        $query .= " WHERE idcontacts='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM contacts ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $ctype = ContactTypesDAO::getByQuery($db, "idcontact_types='{$row['contact_types_idcontact_types']}'", null);
            $uprofile = UserProfileDAO::getByQuery($db, "iduser_profile='{$row['user_profile_iduser_profile']}'", null);
            return new Contacts($row['idcontacts'], $row['number'], $ctype, $row['is_primary'], $uprofile);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM contacts ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }


        $result = $db->query($query);
        $dataset;
        if ($row = mysql_fetch_array($result)) {
            $ctype = ContactTypesDAO::getByQuery($db, "idcontact_types='{$row['contact_types_idcontact_types']}'", null);
            $uprofile = UserProfileDAO::getByQuery($db, "iduser_profile='{$row['user_profile_iduser_profile']}'", null);
            $dataset = new Contacts($row['idcontacts'], $row['number'], $ctype, $row['is_primary'], $uprofile);
        }
        return $dataset;
    }

}

?>