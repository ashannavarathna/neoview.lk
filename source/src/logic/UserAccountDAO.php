<?php

/**
 * Description of UserAccountDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserAccount.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserRoleDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/StatusDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserProfileDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class UserAccountDAO {

    public static function save($db, $password, $status, $max_login_attempt, $idstatus, $account_verified, $verified_code, $iduser_profile, $iduser_role) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO user_account (password, status, max_login_attempt,status_idstatus,account_verified,verified_code,user_profile_iduser_profile,user_role_iduser_role) VALUES('{$password}','{$status}','{$max_login_attempt}','{$idstatus}','{$account_verified}','{$verified_code}','{$iduser_profile}','{$iduser_role}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM user_account WHERE iduser_account='{$id}'");
    }

    public static function update($db, $id, $password, $status, $max_login_attempt, $idstatus, $account_verified, $verified_code, $iduser_profile, $iduser_role) {
        $query = "UPDATE user_account SET";
        if (isset($password)) {
            $query .=" password='{$password}', ";
        }
        if (isset($status)) {
            $query .=" status='{$status}', ";
        }
        if (isset($max_login_attempt)) {
            $query .= " max_login_attempt='{$max_login_attempt}', ";
        }
        if (isset($iduser_profile)) {
            $query .= " user_profile_iduser_profile='{$iduser_profile}', ";
        }
        if (isset($idstatus)) {
            $query .= " status_idstatus='{$idstatus}', ";
        }
        if (isset($account_verified)) {
            $query .= " account_verified='{$account_verified}', ";
        }
        if (isset($verified_code)) {
            $query .= "verified_coed='{$verified_code}', ";
        }
        if (isset($iduser_role)) {
            $query .= " user_role_iduser_role='{$iduser_role}', ";
        }


        $query .=" WHERE iduser_account='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_account ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $userprofile = UserProfileDAO::getByQuery($db, " iduser_profile={$row['user_profile_iduser_profile']}", null);
            $userrole = UserRoleDAO::getByQuery($db, " iduser_role={$row['user_role_iduser_role']}", null);
            $statusobj = StatusDAO::getByQuery($db, " idstatus={$row['status_idstatus']}", null);
            return new UserAccount($row['iduser_account'], $row['password'], $row['status'], $row['max_login_attempt'], $statusobj, $row['account_verified'], $row['verified_code'], $userprofile, $userrole);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_account ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array(); // data array
        if ($row = mysql_fetch_array($result)) {
            $userprofile = UserProfileDAO::getByQuery($db, " iduser_profile={$row['user_profile_iduser_profile']}", null);
            $userrole = UserRoleDAO::getByQuery($db, " iduser_role={$row['user_role_iduser_role']}", null);
            $statusobj = StatusDAO::getByQuery($db, " idstatus={$row['status_idstatus']}", null);
            $dataset = new UserAccount($row['iduser_account'], $row['password'], $row['status'], $row['max_login_attempt'], $statusobj, $row['account_verified'], $row['verified_code'], $userprofile, $userrole);
        }
        return $dataset;
    }

}

?>