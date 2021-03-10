<?php

/**
 * Description of ProdcutCommentReplysDAO
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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ProductCommentReplys.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductCommentsDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserProfileDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';

class ProductCommentReplysDAO {

    public static function save($db, $comment, $idproduct_comment, $datetime, $iduser_profile) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("INSERT INTO prodcut_comment_replys (comment,prodcut_comments_idproduct_comments,datetime,user_profile_iduser_profile) VALUES('{$comment}','{$idproduct_comment}','{$datetime}','{$iduser_profile}'");
    }

    public static function delete($db, $id) {
        if (!isset($db)) {
            $db = new db_conn();
        }
        return $db->query("DELETE FROM prodcut_comment_replys WHERE idprodcut_comment_replys='{$id}'");
    }

    public static function update($db, $id, $comment, $idproduct_comment, $datetime, $iduser_profile) {
        $query = "UPDATE prodcut_comment_replys SET";
        if (!isset($db)) {
            $db = new db_conn();
        }
        if (isset($comment)) {
            $query .= " comment='{$comment}', ";
        }
        if (isset($idproduct_comment)) {
            $query .= " prodcut_comments_idproduct_comments='{$idproduct_comment}', ";
        }
        if (isset($datetime)) {
            $query .= " datetime='{$datetime}', ";
        }
        if (isset($iduser_profile)) {
            $query .= " user_profile_iduser_profile='{$iduser_profile}', ";
        }

        $query .= " WHERE idprodcut_comment_replys='{$id}'";
        $query = Common::removeunwantedcahrbackword(str_split($query), ",", 1, Common::searchspecwordlocationinstring($query, "WHERE")[0]);
        return $db->query($query);
    }

    public static function getByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM prodcut_comment_replys ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }
        $query .= " limit 1";

        $result = $db->query($query);

        if ($row = mysql_fetch_array($result)) {
            $product_comment = ProductCommentsDAO::getByQuery($db, " idprodcut_comments='{$row['prodcut_comments_idproduct_comments']}'", null);
            $userprofile = UserProfileDAO::getByQuery($db, " iduser_profile={$row['user_profile_iduser_profile']}", null);
            return new ProductCommentReplys($row['idproduct_commnet_replys'], $product_comment, $row['datetime'], $userprofile);
        }
        return null;
    }

    public static function listByQuery($db, $condition, $oderby) {
        if (!isset($db)) {
            $this->$db = new db_conn();
        }

        $query = "SELECT * FROM prodcut_comment_replys ";
        if ($condition != null) {
            $query .= " WHERE " . $condition;
        }

        if ($oderby != null) {
            $query .= " ORDER BY " . $oderby;
        }

        $result = $db->query($query);
        $dataset;
        if ($row = mysql_fetch_array($result)) {
            $product_comment = ProductCommentsDAO::getByQuery($db, " idprodcut_comments='{$row['prodcut_comments_idproduct_comments']}'", null);
            $userprofile = UserProfileDAO::getByQuery($db, " iduser_profile={$row['user_profile_iduser_profile']}", null);
            $dataset = new ProductCommentReplys($row['idproduct_commnet_replys'], $product_comment, $row['datetime'], $userprofile);
        }
        return $dataset;
    }

}
