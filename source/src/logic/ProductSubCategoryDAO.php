<?php

/**
 * Description of ProductSubCategoryDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ProductSubCategory.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductCategoryDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class ProductSubCategoryDAO {

    public static function save($db, $code, $name, $idproduct_category) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO product_sub_category (code,name,product_category_idproduct_category) VALUES('{$code}','{$name}','{$idproduct_category}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM product_sub_category WHERE idproduct_sub_category='{$id}'");
    }

    public static function update($db, $id, $code, $name, $idproduct_categorye) {
        $query = "UPDATE product_sub_category SET";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($code)) {
            $query .= " code='{$code}', ";
        }
        if (isset($name)) {
            $query .= " name='{$name}', ";
        }
        if (isset($idproduct_categorye)) {
            $query .= "product_category_idproduct_category='{$idproduct_categorye}', ";
        }

        $query .= " WHERE idproduct_sub_category='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM product_sub_category ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $procategory = ProductCategoryDAO::getByQuery($db, " idproduct_category='{$row['product_category_idproduct_category']}'", null);
            return new ProductSubCategory($row['idproduct_sub_category'], $row['code'], $row['name'], $procategory);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM product_sub_category ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $procategory = ProductCategoryDAO::getByQuery($db, " idproduct_category='{$row['product_category_idproduct_category']}'", null);
            $dataset[] = new ProductSubCategory($row['idproduct_sub_category'], $row['code'], $row['name'], $procategory);
        }
        return $dataset;
    }

}

?>