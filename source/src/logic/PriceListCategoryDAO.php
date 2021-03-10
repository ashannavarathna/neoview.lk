<?php

/**
 * Description of BrandDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/PriceListCategory.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class PriceListCategoryDAO {

    public static function save($db, $name, $image_name) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO price_list_category (name,image_name) VALUES('{$name}','{$image_name}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM price_list_category WHERE idprice_list_category='{$id}'");
    }

    public static function update($db, $id, $name, $image_name) {
        $query = "UPDATE price_list_category SET ";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($name)) {
            $query .= " name='{$name}', ";
        }

        if (isset($image_name)) {
            $query .= " image_name = '{$image_name}', ";
        }

        $query .= " WHERE idprice_list_category='{$id}' ";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
//        return $query;
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM price_list_category ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            return new PriceListCategory($row['idprice_list_category'], $row['name'], $row['image_name']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM price_list_category ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $dataset[] = new PriceListCategory($row['idprice_list_category'], $row['name'], $row['image_name']);
        }
        return $dataset;
    }

}

?>