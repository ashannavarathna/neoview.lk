<?php

/**
 * Description of UserInterfaceDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserInterface.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class UserInterfaceDAO {

    public static function save($db, $name, $status, $inf_code, $url) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("INSERT INTO user_interface (name,status,inf_code,url) VALUES('{$name}','{$status}','{$inf_code}','{$url}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new $db_conn();
        }
        return $db->query("DELETE FROM user_interface WHERE iduser_interface='{$id}'");
    }

    public static function update($db, $id, $name, $status, $inf_code, $url) {
        $query = "UPDATE user_interface SET ";
        if (!isset($db)) {
            $db = new db_conn();
        }

        if (isset($name)) {
            $query .= " name='{$name}', ";
        }
        if (isset($status)) {
            $query .= " status='{$status}', ";
        }
        if (isset($inf_code)) {
            $query .= " inf_code='{$inf_code}', ";
        }
        if (isset($url)) {
            $query .= " url='{$url}', ";
        }

        $query .= " WHERE iduser_interface='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_interface ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            return new UserInterface($row['iduser_interface'], $row['name'], $row['status'], $row['inf_code'], $row['url']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $db = new $db_conn();
        }

        $query = "SELECT * FROM user_interface ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }


        $result = $db->query($query);
        $dataset;
        if ($row = mysql_fetch_array($result)) {
            return new UserInterface($row['iduser_interface'], $row['name'], $row['status'], $row['inf_code'], $row['url']);
        }
        return $dataset;
    }

}

?>