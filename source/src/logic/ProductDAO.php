<?php

/**
 * Description of ProductDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Product.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSubCategoryDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Brand.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/BrandDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/OffersDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/FeaturedProductsMenusDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class ProductDAO {

    public static function save($db, $code, $name, $order, $idbrand, $idproduct_sub_category, $description, $idoffers, $retail_price, $wholesale_price, $is_featured, $img_name, $dealer_price, $status, $product_type) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        $query = '';
        //full query
//        $query = "INSERT INTO product (code,name,porder,brand_idbrand,product_sub_category_idproduct_sub_category,description,offers_idoffers,retail_price,wholesale_price,featured_products_menus_idfeatured_products_menus,img_name,dealer_price) VALUES('{$code}','{$name}','{$order}','{$idbrand}','{$idproduct_sub_category}','{$description}','{$idoffers}','{$retail_price}','{$wholesale_price}','{$idfeatured_menu}','{$img_name}','{$dealer_price}')";
        if (!isset($idoffers) || $idoffers == 0) {
            $query = "INSERT INTO product (code,name,porder,brand_idbrand,product_sub_category_idproduct_sub_category,description,retail_price,wholesale_price,is_featured,img_name,dealer_price,status,product_type) VALUES('{$code}','{$name}','{$order}','{$idbrand}','{$idproduct_sub_category}','{$description}','{$retail_price}','{$wholesale_price}','{$is_featured}','{$img_name}','{$dealer_price}','{$status}','{$product_type}')";
        } else {
            $query = "INSERT INTO product (code,name,porder,brand_idbrand,product_sub_category_idproduct_sub_category,description,offers_idoffers,retail_price,wholesale_price,is_featured,img_name,dealer_price,status,product_type) VALUES('{$code}','{$name}','{$order}','{$idbrand}','{$idproduct_sub_category}','{$description}','{$idoffers}','{$retail_price}','{$wholesale_price}','{$is_featured}','{$img_name}','{$dealer_price}','{$status}','{$product_type}')";
        }


        return $db->query_n_err($query);
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM product WHERE idproduct='{$id}'");
    }

    public static function update($db, $id, $code, $name, $porder, $idbrand, $idproduct_sub_category, $description, $idoffers, $is_featured, $img_name, $retail_price, $wholesale_price, $dealer_price, $status, $product_type) {
        $query = "UPDATE product SET";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($code)) {
            $query .= " code='{$code}', ";
        }
        if (isset($name)) {
            $query .= " name='{$name}', ";
        }
        if (isset($porder)) {
            $query .= " porder='{$porder}', ";
        }
        if (isset($idbrand)) {
            $query .= " brand_idbrand='{$idbrand}', ";
        }
        if (isset($idproduct_sub_category)) {
            $query .= " product_sub_category_idproduct_sub_category='{$idproduct_sub_category}', ";
        }
        if (isset($description)) {
            $query .= " description='{$description}', ";
        }
        if (isset($idoffers)) {
            $query .= " offers_idoffers='{$idoffers}', ";
        }
        if (isset($is_featured)) {
            $query .= " is_featured='{$is_featured}', ";
        }
        if (isset($img_name)) {
            $query .= " img_name='{$img_name}', ";
        }
        if (isset($retail_price)) {
            $query .= " retail_price='{$retail_price}', ";
        }
        if (isset($wholesale_price)) {
            $query .= " wholesale_price='{$wholesale_price}', ";
        }
        if (isset($dealer_price)) {
            $query .= " dealer_price='{$dealer_price}', ";
        }
        if (isset($status)) {
            $query .= " status='{$status}',";
        }
        if (isset($product_type)) {
            $query .=" product_type='{$product_type}'";
        }

        $query .= " WHERE idproduct='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query_n_err($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM product ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $brand = BrandDAO::getByQuery($db, " idbrand='{$row['brand_idbrand']}'", null);
            $product_sub_cat = ProductSubCategoryDAO::getByQuery($db, " idproduct_sub_category='{$row['product_sub_category_idproduct_sub_category']}'", null);
            $offers = OffersDAO::getByQuery($db, " idoffers='{$row['offers_idoffers']}'", null);
            return new Product($row['idproduct'], $row['code'], $row['name'], $row['porder'], $brand, $product_sub_cat, $row['description'], $offers, $row['retail_price'], $row['wholesale_price'], $row['is_featured'], $row['img_name'], $row['dealer_price'], $row['status'], $row['product_type']);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM product ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $brand = BrandDAO::getByQuery($db, " idbrand='{$row['brand_idbrand']}'", null);
            $product_sub_cat = ProductSubCategoryDAO::getByQuery($db, " idproduct_sub_category='{$row['product_sub_category_idproduct_sub_category']}'", null);
            $offers = OffersDAO::getByQuery($db, " idoffers='{$row['offers_idoffers']}'", null);

            $dataset[] = new Product($row['idproduct'], $row['code'], $row['name'], $row['porder'], $brand, $product_sub_cat, $row['description'], $offers, $row['retail_price'], $row['wholesale_price'], $row['is_featured'], $row['img_name'], $row['dealer_price'], $row['status'], $row['product_type']);
        }
        return $dataset;
    }

}

?>