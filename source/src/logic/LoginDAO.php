<?php

/**
 * Description of LoginDAO
 *
 * @author ashan nawarathna
 */
//Document Root Path
$document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';
//sub inclued files
//online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Login.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserAccountDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class LoginDAO {

    public static function save($db, $login_time, $logout_time, $is_logged, $session_id, $cookie_id, $iduser_account, $ip, $device_info) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO login (login_time, logout_time, is_logged,  session_id, cookie_id, user_account_iduser_account, ip,device_info) VALUES('{$login_time}','{$logout_time}','{$is_logged}','{$session_id}','{$cookie_id}','{$iduser_account}','{$ip}','{$device_info}',)");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM login WHERE idlogin='{$id}'");
    }

    public static function update($db, $id, $login_time, $logout_time, $is_logged, $session_id, $cookie_id, $iduser_account, $ip, $device_info) {
        $query = "UPDATE login SET";
        if (isset($login_time)) {
            $query .=" login_time='{$login_time}', ";
        }
        if (isset($logout_time)) {
            $query .=" logout_time='{$logout_time}', ";
        }
        if (isset($is_logged)) {
            $query .= " is_logged='{$is_logged}', ";
        }
        if (isset($session_id)) {
            $query .= " session_id='{$session_id}', ";
        }
        if (isset($cookie_id)) {
            $query .= " cookie_id='{$cookie_id}', ";
        }
        if (isset($iduser_account)) {
            $query .= " user_account_iduser_account='{$iduser_account}', ";
        }
        if (isset($ip)) {
            $query .= "ip='{$ip}', ";
        }
        if (isset($device_info)) {
            $query .= " device_info='{$device_info}', ";
        }


        $query .=" WHERE idlogin='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM login ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $useraccount = UserAccountDAO::getByQuery($db, "iduser_account={$row['user_account_iduser_account']}", null);
            return new Login($row['idlogin'], $row['login_time'], $row['logout_time'], $row['is_logged'], $row['session_id'], $row['cookie_id'], $useraccount, $row['ip'], $row['device_info']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM login ";
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
            $dataset = new Login($row['idlogin'], $row['login_time'], $row['logout_time'], $row['is_logged'], $row['session_id'], $row['cookie_id'], $useraccount, $row['ip'], $row['device_info']);
        }
        return $dataset;
    }

}

?>