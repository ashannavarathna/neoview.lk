<?php

/**
 * Description of FeaturedProductsMenusDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/FeaturedProductsMenus.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class FeaturedProductsMenusDAO {

    public static function save($db, $name, $description) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO featured_products_menus (name,description) VALUES('{$name}','{$description}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM featured_products_menus WHERE idfeatured_products_menus='{$id}'");
    }

    public static function update($db, $id, $name, $description) {
        $query = "UPDATE featured_products_menus SET";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($name)) {
            $query .= " name='{$name}', ";
        }
        if (isset($description)) {
            $query .= " description='{$description}', ";
        }

        $query .= " WHERE idfeatured_products_menus='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM featured_products_menus ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            return new FeaturedProductsMenus($row['idfeatured_products_menus'], $row['name'], $row['description']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM featured_products_menus ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $dataset[] = new FeaturedProductsMenus($row['idfeatured_products_menus'], $name['name'], $row['description']);
        }
        return $dataset;
    }

}

?>