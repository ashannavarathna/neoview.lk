<?php

/**
 * Description of ProdcutCategoryDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ProductCategory.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class ProductCategoryDAO {

    public static function save($db, $code, $name) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO product_category (code,name) VALUES('{$code}','{$name}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM product_category WHERE idproduct_category='{$id}'");
    }

    public static function update($db, $id, $code, $name) {
        $query = "UPDATE product_category SET";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($code)) {
            $query .= " code='{$code}', ";
        }
        if (isset($name)) {
            $query .= " name='{$name}', ";
        }

        $query .= " WHERE idproduct_category='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM product_category ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            return new ProductCategory($row['idproduct_category'], $row['code'], $row['name']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM product_category ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $dataset[] = new ProductCategory($row['idproduct_category'], $row['code'], $row['name']);
        }
        return $dataset;
    }

}

?>