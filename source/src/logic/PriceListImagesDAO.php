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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/PriceListCategory.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/PriceListImages.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class PriceListImagesDAO {

    public static function save($db, $image_name, $idprice_list_category) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO price_list_images (image_name,price_list_category_idprice_list_category) VALUES('{$image_name}','{$idprice_list_category}')");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM price_list_images WHERE idprice_list_images='{$id}'");
    }

    public static function update($db, $id, $image_name, $idprice_list_category) {
        $query = "UPDATE price_list_images SET ";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($image_name)) {
            $query .= " image_name='{$image_name}', ";
        }
        if (isset($idprice_list_category)) {
            $query .= " price_list_category_idprice_list_category='{$idprice_list_category}', ";
        }

        $query .= " WHERE idprice_list_images='{$id}' ";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
//        return $query;
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM price_list_images ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $prolstcategory = PriceListCategoryDAO::getByQuery($db, " idprice_list_category='{$row['price_list_category_idprice_list_category']}'", null);
            return new PriceListImages($row['idprice_list_images'], $row['image_name'], $prolstcategory);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM price_list_images ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $prolstcategory = PriceListCategoryDAO::getByQuery($db, " idprice_list_category='{$row['price_list_category_idprice_list_category']}'", null);
            $dataset[] = new PriceListImages($row['idprice_list_images'], $row['image_name'], $prolstcategory);
        }
        return $dataset;
    }

}

?>