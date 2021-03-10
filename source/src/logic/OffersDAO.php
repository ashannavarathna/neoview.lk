<?php

/**
 * Description of OffersDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Offers.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class OffersDAO {

    public static function save($db, $name, $description, $discount_prsnt, $discount_amnt, $startdate, $enddate) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO offers (name,description,discount_prasentage,discount_amount,startdate,enddate) VALUES('{$name}','{$description}','{$discount_prsnt}','{$discount_amnt}','{$startdate}','{$enddate}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM offers WHERE idoffers='{$id}'");
    }

    public static function update($db, $id, $name, $description, $discount_prsnt, $discount_amnt, $startdate, $enddate) {
        $query = "UPDATE offers SET";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($name)) {
            $query .= " name='{$name}', ";
        }
        if (isset($description)) {
            $query .= " description='{$description}', ";
        }
        if (isset($discount_prsnt)) {
            $query .= " discount_prasentage='{$discount_prsnt}', ";
        }
        if (isset($discount_amnt)) {
            $query .= " discount_amount='{$discount_amnt}', ";
        }
        if (isset($startdate)) {
            $query .= " startdate='{$startdate}', ";
        }
        if (isset($enddate)) {
            $query .= " enddate='{$enddate}', ";
        }

        $query .= " WHERE idoffers='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM offers ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            return new Offers($row['idoffers'],$row['name'], $row['description'], $row['discount_prasentage'], $row['discount_amount'], $row['startdate'], $row['enddate']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM offers ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $dataset[] = new Offers($row['idoffers'], $row['name'], $row['description'], $row['discount_prasentage'], $row['discount_amount'], $row['startdate'], $row['enddate']);
        }
        return $dataset;
    }

}

?>