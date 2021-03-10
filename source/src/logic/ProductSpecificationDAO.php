<?php

/**
 * Description of ProductSpecificationDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ProductSpecification.php';

class ProductSpecificationDAO {

    public static function save($db, $imgname1, $imgname2, $imgname3, $long_description, $product_model, $product_features, $released_on, $idproduct) {
        if (!isset($db)) {
            $db = new db_conn();
        }

        $query = "INSERT INTO product_specification (imgname1,imgname2,imgname3,long_description,product_model,product_features,released_on,product_idproduct) VALUES ('{$imgname1}','{$imgname2}','{$imgname3}','{$long_description}','{$product_model}','{$product_features}','{$released_on}','{$idproduct}')";
        return $db->query($query);
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM product_specification WHERE idproduct_specification='{$id}'");
    }

    public static function update($db, $id, $imgname1, $imgname2, $imgname3, $long_description, $product_model, $product_features, $released_on, $idproduct) {
        $query = "UPDATE product_specification SET";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($imgname1)) {
            $query .= " imgname1='{$imgname1}', ";
        }
        if (isset($imgname2)) {
            $query .= " imgname2='{$imgname2}', ";
        }
        if (isset($imgname3)) {
            $query .= " imgname3='{$imgname3}', ";
        }
        if (isset($long_description)) {
            $query .= " long_description='{$long_description}', ";
        }
        if (isset($product_model)) {
            $query .= " product_model='{$product_model}', ";
        }
        if (isset($product_features)) {
            $query .= " product_features='{$product_features}', ";
        }
        if (isset($released_on)) {
            $query .= " released_on='{$released_on}', ";
        }
        if (isset($idproduct)) {
            $query .= " product_idproduct='{$idproduct}', ";
        }

        $query .= " WHERE idproduct_specification='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query_n_err($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM product_specification ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $product = ProductDAO::getByQuery($db, " idproduct='{$row['product_idproduct']}'", null);
            return new ProductSpecification($row['idproduct_specification'], $row['imgname1'], $row['imgname2'], $row['imgname3'], $row['long_description'], $row['product_model'], $row['product_features'], $row['released_on'], $product);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM product_specification ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset = array();
        while ($row = mysql_fetch_array($result)) {
            $product = ProductDAO::getByQuery($db, " idproduct='{$row['product_idproduct']}'", null);
            $dataset[] = new ProductSpecification($row['idproduct_specification'], $row['imgname1'], $row['imgname2'], $row['imgname3'], $row['long_description'], $row['product_model'], $row['product_features'], $row['released_on'], $product);
        }
        return $dataset;
    }

}
