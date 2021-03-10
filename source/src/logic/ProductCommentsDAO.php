<?php

/**
 * Description of ProductCommentsDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ProductComments.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserProfileDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class ProductCommentsDAO {

    public static function save($db, $comment, $idproduct, $datetime, $iduser_profile) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO prodcut_comments (comment,prodcut_idproduct,datetime,user_profile_iduser_profile) VALUES('{$comment}','{$idproduct}','{$datetime}','{$iduser_profile}'");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM prodcut_comments WHERE idprodcut_comments='{$id}'");
    }

    public static function update($db, $id, $comment, $idproduct, $datetime, $iduser_profile) {
        $query = "UPDATE prodcut_comments SET";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($comment)) {
            $query .= " comment='{$comment}', ";
        }
        if (isset($idproduct)) {
            $query .= " prodcut_idproduct='{$idproduct}', ";
        }
        if (isset($datetime)) {
            $query .= " datetime='{$datetime}', ";
        }
        if (isset($iduser_profile)) {
            $query .= " user_profile_iduser_profile='{$iduser_profile}', ";
        }

        $query .= " WHERE idprodcut_comments='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM prodcut_comments ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $userprofile = UserProfileDAO::getByQuery($db, " iduser_profile={$row['user_profile_iduser_profile']}", null);
            $product = ProductDAO::getByQuery($db, " idproduct='{$row['product_idprodcut']}'", null);
            return new ProductComments($row['idproduct_comments'], $row['comment'], $product, $row['datetime'], $userprofile);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM prodcut_comments ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset;
        if ($row = mysql_fetch_array($result)) {
            $userprofile = UserProfileDAO::getByQuery($db, " iduser_profile={$row['user_profile_iduser_profile']}", null);
            $product = ProductDAO::getByQuery($db, " idproduct='{$row['product_idprodcut']}'", null);
            $dataset = new ProductComments($row['idproduct_comments'], $row['comment'], $product, $row['datetime'], $userprofile);
        }
        return $dataset;
    }

}

?>