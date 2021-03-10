<?php

session_start();

$document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
//echo $document_root . '/__rootaccess_prams.php';
//
//online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';

//sub inclued files
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/connection/db_conn.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProdcutCategoryDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSubCategoryDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/BrandDAO.php';
$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}

//json data set
$success = false;
$message = 'server_messages => no from submitted!';
$response = array();


if (isset($_POST['submit_type'])) {
    //get which from is submitted
    $submit_type = $_POST['submit_type'];
    $name = null;
    $code = null;

    if ($submit_type == 'productcategory') {
        $code = $_POST['code'];
        $name = $_POST['name'];

        //varibel for duplication
        $flag_name = true;
        $flag_code = true;

        if (empty(trim($code))) {
            $flag_code = false;
            $code = null;
            $message = " code can not be empty!";
        } else {
            $result_code = $connection_db->query("SELECT count(idproduct_category) as count_ FROM product_category where code='{$code}'");
            //check code duplication
            if ($row = mysql_fetch_array($result_code)) {
                if ($row['count_'] > 0) {
                    $code = null;
                    $flag_code = false;
                    $message = ' code already exists!';
                }
            }
        }

        if (empty(trim($name))) {
            $flag_name = false;
            $name = null;
            $message = " name can not be empty!";
        } else {
            $result_name = $connection_db->query("SELECT count(idproduct_category) as count_ FROM product_category where name='{$name}'");
            //check name duplication
            if ($row = mysql_fetch_array($result_name)) {
                if ($row['count_'] > 0) {
                    $name = null;
                    $flag_name = false;
                    $message = ' name already exists!';
                }
            }
        }

        if ($flag_code && $flag_name) {
            if (ProdcutCategoryDAO::save($connection_db, $code, $name)) {
                $message = " category saved!";
                $success = true;
            } else {
                $message = " can not save product category";
            }
        }
    } else if ($submit_type == 'productsubcategory') {
        $code = $_POST['code'];
        $name = $_POST['name'];
        $mcatid = $_POST['mcatid'];

        //varibel for duplication
        $flag_name = true;
        $flag_code = true;

        if (empty(trim($mcatid))) {
            $flag_name = false;
            $flag_code = false;
            $message = " no main category found!";
        }

        if (empty(trim($code))) {
            $flag_code = false;
            $code = null;
            $message = " code can not be empty!";
        } else {
            $result_code = $connection_db->query("SELECT count(idproduct_sub_category) as count_ FROM product_sub_category where code='{$code}'");
            //check code duplication
            if ($row = mysql_fetch_array($result_code)) {
                if ($row['count_'] > 0) {
                    $code = null;
                    $flag_code = false;
                    $message = ' code already exists!';
                }
            }
        }

        if (empty(trim($name))) {
            $flag_name = false;
            $name = null;
            $message = ' name can not be empty!';
        } else {
            $result_name = $connection_db->query("SELECT count(idproduct_sub_category) as count_ FROM product_sub_category where name='{$name}'");
            //check name duplication
            if ($row = mysql_fetch_array($result_name)) {
                if ($row['count_'] > 0) {
                    $name = null;
                    $flag_name = false;
                    $message = ' name already exists!';
                }
            }
        }

        if ($flag_code && $flag_name) {
            if (ProductSubCategoryDAO::save($connection_db, $code, $name, $mcatid)) {
                $message = " sub category saved!";
                $success = true;
            } else {
                $message = " can not save sub product category";
            }
        }
    } else if ($submit_type == 'productbrand') {
        $code = $_POST['code'];
        $name = $_POST['name'];
        $description = null;

        //varibel for duplication
        $flag_name = true;
        $flag_code = true;

//        if (empty(trim($description))) {
//            $flag_name = false;
//            $flag_code = false;
//            $message = " no description found!";
//        }

        if (empty(trim($code))) {
            $flag_code = false;
            $code = null;
            $message = " code can not be empty!";
        } else {
            $result_code = $connection_db->query("SELECT count(idbrand) as count_ FROM brand where code='{$code}'");
            //check code duplication
            if ($row = mysql_fetch_array($result_code)) {
                if ($row['count_'] > 0) {
                    $code = null;
                    $flag_code = false;
                    $message = ' code already exists!';
                }
            }
        }

        if (empty(trim($name))) {
            $flag_name = false;
            $name = null;
            $message = ' name can not be empty!';
        } else {
            $result_name = $connection_db->query("SELECT count(idbrand) as count_ FROM brand where name='{$name}'");
            //check name duplication
            if ($row = mysql_fetch_array($result_name)) {
                if ($row['count_'] > 0) {
                    $name = null;
                    $flag_name = false;
                    $message = ' name already exists!';
                }
            }
        }

        if ($flag_code && $flag_name) {
            if (BrandDAO::save($connection_db, $code, $name, $description)) {
                $message = " brand saved!";
                $success = true;
            } else {
                $message = " can not save brand!";
            }
        }
    }
}



//json responce
$response["data"] = array("success" => $success, "message" => $message);
$json = json_encode($response, JSON_FORCE_OBJECT);
echo $json;
?>