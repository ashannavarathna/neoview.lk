<?php

//Document Root Path
$document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
//online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';
//sub inclued files
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/connection/db_conn.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
//require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ProductSpecification.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSpecificationDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductCategoryDAO.php';

$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}

//json data set
$success = false;
$message = 'server_messages => no from submitted!';
$response = array();

if (isset($_POST['action'])) {

    $action = $_POST['action'];
    $id = $_POST['id'];
    $value = $_POST['value'];

    if ($action == 'changeprodcutreafuredsatus') {
        $setto;
        if ($value == 1) {
            $setto = 0;
        } else {
            $setto = 1;
        }

        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, null, null, $setto, null, null, null, null, null, null)) {
            if ($setto == 1) {
                $message = "Featured product active!";
            } else {
                $message = "Featured product removed!";
            }
            $success = true;
        } else {
            $message = "error ocured!";
        }
    } else if ($action == 'removeproduct') {

        //check for foreign keys : add if more table avl
        $flag_enable_delete_product = true;
//        $result = array();
        $result = $connection_db->query("select count(product_idproduct) from product_comments where product_idproduct='{$id}'");
//        $result[] = $connection_db->query("select count(product_idproduct) from product_specification where product_idproduct='{$id}'");
        while ($row = mysql_fetch_array($result)) {
            if ($row[0] > 0) {
                $flag_enable_delete_product = false;
                break;
            }
        }
        if ($flag_enable_delete_product) {
            $ob = ProductSpecificationDAO::getByQuery($connection_db, " product_idproduct='{$id}'", null);
            if ($ob != null) {
                //delete product spec object
                ProductSpecificationDAO::delete($connection_db, $ob->getId());
            }
            if (ProductDAO::delete($connection_db, $id)) {
                $message = ' product deleted!';
                $success = true;
            } else {
                $message = "error ocured!";
            }
        } else {
            $message = " this product associate with more table. please contact system admin!";
        }
    } else if ($action == 'updateproductorder') {
        if (ProductDAO::update($connection_db, $id, null, null, $value, null, null, null, null, null, null, null, null, null, null, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!";
        }
    } else if ($action == 'updateproductbrand') {
        $value = trim($value);
        if ($value == "") {
            $message = " please select a brand!";
        } else {
            if (ProductDAO::update($connection_db, $id, null, null, null, $value, null, null, null, null, null, null, null, null, null, null)) {
                $message = " product updated!";
                $success = true;
            } else {
                $message = " can not update product!!";
            }
        }
    } else if ($action == 'updateproductcode') {
        if (ProductDAO::update($connection_db, $id, $value, null, null, null, null, null, null, null, null, null, null, null, null, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!";
        }
    } else if ($action == 'updateproductname') {
        if (ProductDAO::update($connection_db, $id, null, $value, null, null, null, null, null, null, null, null, null, null, null, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!";
        }
    } else if ($action === 'updateproductshortdescription') {
        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, $value, null, null, null, null, null, null, null, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = "can not update product!";
        }
    } else if ($action == 'updateproductofferceid') {
        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, null, $value, null, null, null, null, null, null, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!";
        }
    } else if ($action == 'updatedeproductfaultimage') {
//        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, null, null, null, $value, null, null, null)) {
//            $message = " product updated!";
//        } else {
//            $message = " can not update product!";
//        }
    } else if ($action == 'updateproductretailprice') {
        $value = Common::removeunwantedcahrbackword(str_split($value), ",", 1, Common::searchspecwordlocationinstring($value, ".")[0]);
        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, null, null, null, null, $value, null, null, null, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!";
        }
    } else if ($action == 'updateproductwholesaleprice') {
        $value = Common::removeunwantedcahrbackword(str_split($value), ",", 1, Common::searchspecwordlocationinstring($value, ".")[0]);
        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, null, null, null, null, null, $value, null, null, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!!!";
        }
//        $messag = ProductDAO::update($connection_db, $id, null, null, null, null, null, null, null, null, null, null, $value, null);
    } else if ($action == 'updateproductdealerprice') {
        $value = Common::removeunwantedcahrbackword(str_split($value), ",", 1, Common::searchspecwordlocationinstring($value, ".")[0]);
        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, null, null, null, null, null, null, $value, null, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!!";
        }
    } else if ($action == 'updateproductstatus') {
        $value = trim($value);
        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, null, null, null, null, null, null, null, $value, null)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!!";
        }
    } else if ($action == 'updateproducttype') {
        $value = trim($value);
        if (ProductDAO::update($connection_db, $id, null, null, null, null, null, null, null, null, null, null, null, null, null, $value)) {
            $message = " product updated!";
            $success = true;
        } else {
            $message = " can not update product!!";
        }
    } else if ($action === 'updateproductspecdescription') {
        if (ProductSpecificationDAO::update($connection_db, $id, null, null, null, $value, null, null, null, null)) {
            $message = " product spec updated!";
            $success = true;
        } else {
            $message = " can not update product spec!";
        }
    } else if ($action == 'updateproductspecmodel') {
        if (ProductSpecificationDAO::update($connection_db, $id, null, null, null, null, $value, null, null, null)) {
            $message = " product spec updated!";
            $success = true;
        } else {
            $message = " can not update product spec!";
        }
    } else if ($action == 'updateproductspecfeatures') {
        if (ProductSpecificationDAO::update($connection_db, $id, null, null, null, null, null, $value, null, null)) {
            $message = " productspec updated!";
            $success = true;
        } else {
            $message = " can not update product spec!";
        }
    } else if ($action == 'updateproductspecreleaseondate') {
        if (ProductSpecificationDAO::update($connection_db, $id, null, null, null, null, null, null, $value, null)) {
            $message = " product spec updated!";
            $success = true;
        } else {
            $message = " can not update product spec!";
        }
    } else if ($action == "updatemaincategory") {
        //check code exits
        $code = $_POST['code'];
        $name = $_POST['name'];


        //varibel for duplication
        $flag_name = true;
        $flag_code = true;

        if (empty(trim($code))) {
            $flag_code = false;
            $code = null;
        } else {
            $result_code = $connection_db->query("SELECT count(idproduct_category) as count_ FROM product_category where code='{$code}'");
            //check code duplication
            if ($row = mysql_fetch_array($result_code)) {
                if ($row['count_'] > 0) {
                    $code = null;
                    $flag_code = false;
                }
            }
        }

        if (empty(trim($name))) {
            $flag_name = false;
            $name = null;
        } else {
            $result_name = $connection_db->query("SELECT count(idproduct_category) as count_ FROM product_category where name='{$name}'");
            //check name duplication
            if ($row = mysql_fetch_array($result_name)) {
                if ($row['count_'] > 0) {
                    $name = null;
                    $flag_name = false;
                }
            }
        }

        if ($flag_code || $flag_name) {
            if (ProdcutCategoryDAO::update($connection_db, $id, $code, $name)) {
                $message = " category updated!";
                $success = true;
            } else {
                $message = " can not update product category";
            }
        } else {
            $message = " category code or name already in use!";
        }
    } else if ($action == "removemaincategory") {
        //check code exits
        $result = $connection_db->query("SELECT count(idproduct_sub_category) as count_ FROM product_sub_category where product_category_idproduct_category='{$id}'");
        $flag_remove = true;
        if ($row = mysql_fetch_array($result)) {
            if ($row['count_'] == 0) {
                if (ProdcutCategoryDAO::delete($connection_db, $id)) {
                    $message = " category removed!";
                    $success = true;
                } else {
                    $message = " can not remove product category";
                }
            } else {
                $message = " this main category associate with more table. please contact system admin!";
            }
        }
    } else if ($action == "updateproductsubcategory") {
        //check code exits
        $code = $_POST['code'];
        $name = $_POST['name'];


        //varibel for duplication
        $flag_name = true;
        $flag_code = true;



        if (empty(trim($code))) {
            $flag_code = false;
            $code = null;
        } else {
            $result_code = $connection_db->query("SELECT count(idproduct_sub_category) as count_ FROM product_sub_category where code='{$code}'");
            //check code duplication
            if ($row = mysql_fetch_array($result_code)) {
                if ($row['count_'] > 0) {
                    $code = null;
                    $flag_code = false;
                }
            }
        }

        if (empty(trim($name))) {
            $flag_name = false;
            $name = null;
        } else {
            $result_name = $connection_db->query("SELECT count(idproduct_sub_category) as count_ FROM product_sub_category where name='{$name}'");
            //check name duplication
            if ($row = mysql_fetch_array($result_name)) {
                if ($row['count_'] > 0) {
                    $name = null;
                    $flag_name = false;
                }
            }
        }

        if ($flag_code || $flag_name) {
            if (ProductSubCategoryDAO::update($connection_db, $id, $code, $name, null)) {
                $message = " sub category updated!";
                $success = true;
            } else {
                $message = " can not update product sub category";
            }
        } else {
            $message = " sub category code or name already in use!";
        }
    } else if ($action == "removeproductsubcategory") {
        //check code exits
        $result = $connection_db->query("SELECT count(idproduct) as count_ FROM product where product_sub_category_idproduct_sub_category='{$id}'");
        $flag_remove = true;
        if ($row = mysql_fetch_array($result)) {
            if ($row['count_'] == 0) {
                if (ProductSubCategoryDAO::delete($connection_db, $id)) {
                    $message = " sub category removed!";
                    $success = true;
                } else {
                    $message = " can not remove product sub category";
                }
            } else {
                $message = " this sub category associate with more table. please contact system admin!";
            }
        }
    } else if ($action == "updateproductbrand") {
        //check code exits
        $code = $_POST['code'];
        $name = $_POST['name'];


        //varibel for duplication
        $flag_name = true;
        $flag_code = true;



        if (empty(trim($code))) {
            $flag_code = false;
            $code = null;
        } else {
            $result_code = $connection_db->query("SELECT count(idbrand) as count_ FROM brand where code='{$code}'");
            //check code duplication
            if ($row = mysql_fetch_array($result_code)) {
                if ($row['count_'] > 0) {
                    $code = null;
                    $flag_code = false;
                }
            }
        }

        if (empty(trim($name))) {
            $flag_name = false;
            $name = null;
        } else {
            $result_name = $connection_db->query("SELECT count(idbrand) as count_ FROM brand where name='{$name}'");
            //check name duplication
            if ($row = mysql_fetch_array($result_name)) {
                if ($row['count_'] > 0) {
                    $name = null;
                    $flag_name = false;
                }
            }
        }

        if ($flag_code || $flag_name) {
            if (BrandDAO::update($connection_db, $id, $code, $name, null)) {
                $message = " brand updated!";
                $success = true;
            } else {
                $message = " can not update brand";
            }
        } else {
            $message = " brand code or name already in use!";
        }
    } else if ($action == "removeproductbrand") {
        //check code exits
        $result = $connection_db->query("SELECT count(idproduct) as count_ FROM product where brand_idbrand='{$id}'");
        $flag_remove = true;
        if ($row = mysql_fetch_array($result)) {
            if ($row['count_'] == 0) {
                if (BrandDAO::delete($connection_db, $id)) {
                    $message = " brand removed!";
                    $success = true;
                } else {
                    $message = " can not remove brand";
                }
            } else {
                $message = " this sub category associate with more table. please contact system admin!";
            }
        }
    }
}

//
//json responce
$response["data"] = array("success" => $success, "message" => $message);
$json = json_encode($response, JSON_FORCE_OBJECT);
echo $json;
?>
