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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSpecificationDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Times.php';
$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}

//json data set
$success = false;
$message = 'server_messages => no from submitted!';
$response = array();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'saveProduct') {


        $poffers_id = 0;
        $pcode = $_POST['pcode'];
        $pname = $_POST['pname'];
        $brand_id = $_POST['pbrand'];
        $psubcat_id = $_POST['psubcategory'];
        if (isset($_POST['poffers']) && $_POST['poffers'] != '') {
            $poffers_id = $_POST['poffers'];
        }
        $retail_price = $_POST['pretail_price'];
        $wholesale_price = $_POST['pwholesale_price'];
        $pdescription = $_POST['pdescription'];
        $dealer_price = $_POST['pdealer_price'];
        $ptype = $_POST['ptype'];

        $prodcut = ProductDAO::getByQuery($connection_db, " name='{$pname}' || code='{$pcode}' ", null);
        if ($prodcut == null) {
            if ($_FILES['file']['type'] != null) {
                $validextensions = array("jpeg", "jpg", "png");
                $temporary = explode(".", $_FILES["file"]["name"]);
                $file_extension = end($temporary);
                if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
                        ) && ($_FILES["file"]["size"] < 1000000)//Approx. 100kb files can be uploaded.
                        && in_array($file_extension, $validextensions)) {
                    if ($_FILES["file"]["error"] > 0) {
                        $message = "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                    } else {
                        $imgname = md5($pname . Times::getFullTime());
                        //                        $_FILES["file"]["name"];
                        $filesavedname = $imgname . '.' . $file_extension;
                        if (file_exists(__rootaccess_prams::$__upload_dir  . $filesavedname)) {
                            $message = $_FILES["file"]["name"] . " already exists => " . $filesavedname;
                        } else {
                            $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                            $targetPath = __rootaccess_prams::$__upload_dir  . $filesavedname; // Target path where file is to be stored
                            //save product data
                            if (ProductDAO::save($connection_db, $pcode, $pname, 0, $brand_id, $psubcat_id, $pdescription, $poffers_id, $retail_price, $wholesale_price, 0, $filesavedname, $dealer_price, 0, $ptype)) {
                                $savedpob = ProductDAO::getByQuery($connection_db, " code='{$pcode}'", null);
                                ProductSpecificationDAO::save($connection_db, null, null, null, null, null, null, "1900-01-01", $savedpob->getId());
                                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                                $message = 'product successfuly saved!';
                                $success = true;
                            } else {
                                $message = 'can not save product! error ocured!';
                            }
                            //                        $message .= "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
                            //                        $message .= "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
                            //                        $message .= "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
                            //                        $message .= "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                            //                        $message .= "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
                        }
                    }
                } else {
                    $message = "invalid image type or size";
                }
            } else {
                //save without image
                if (ProductDAO::save($connection_db, $pcode, $pname, 0, $brand_id, $psubcat_id, $pdescription, $poffers_id, $retail_price, $wholesale_price, 0, "", $dealer_price, 0, $ptype)) {
                    $savedpob = ProductDAO::getByQuery($connection_db, " code='{$pcode}'", null);
                    ProductSpecificationDAO::save($connection_db, null, null, null, null, null, null, "1900-01-01", $savedpob->getId());
                    move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                    $message = 'product successfuly saved!';
                    $success = true;
                } else {
                    $message = 'can not save product! error ocured!';
                }
            }
        } else {

            $message = "product alreday saved!";
        }
    }
}




//json responce
$response["data"] = array("success" => $success, "message" => $message);
$json = json_encode($response, JSON_FORCE_OBJECT);
echo $json;
?>
