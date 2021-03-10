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

if ($_FILES["file"]['type'] != null) {

    $imageoffset = $_POST['imageoffset'];
    $productid = $_POST['productid'];


    $product = ProductDAO::getByQuery($connection_db, " idproduct='{$productid}' ", null);


    if ($product != null) {
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
                ) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if ($_FILES["file"]["error"] > 0) {
                $message = "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
            } else {
                $imgname = md5($product->getName() . Times::getFullTime());
                //                        $_FILES["file"]["name"];
                $filesavedname = $imgname . '.' . $file_extension;
                if (file_exists(__rootaccess_prams::$__upload_dir . "/product_images/" . $filesavedname)) {
                    $message = $_FILES["file"]["name"] . " already exists => " . $filesavedname;
                } else {
                    $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                    $targetPath = __rootaccess_prams::$__upload_dir . "/product_images/" . $filesavedname; // Target path where file is to be stored
                    //save product data
                    if ($imageoffset == 0) {
                                  
//                        $message = ProductDAO::update($db, $id, $code, $name, $porder, $idbrand, $idproduct_sub_category, $description, $idoffers, $is_featured, $img_name, $retail_price, $wholesale_price, $dealer_price, $status, $product_type);
                        if (ProductDAO::update($connection_db, $productid, null, null, null, null, null, null, null, null, $filesavedname,null, null, null, null, null)) {
                            move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                            $message = 'product successfuly saved!';
                            $success = true;
                        } else {
                            $message = 'can not update product image! error ocured!';
                        }
                    } else {
                        $product_spec_ = ProductSpecificationDAO::getByQuery($connection_db, " product_idproduct='{$productid}'", null);
                        if ($product_spec_ != null) {
                            switch ($imageoffset) {
                                case 1:
                                    if (ProductSpecificationDAO::update($connection_db, $product_spec_->getId(), $filesavedname, null, null, null, null, null, null, null)) {
                                        move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                                        $message = 'product successfuly saved!';
                                        $success = true;
                                    } else {
                                        $message = 'can not update product image! error ocured!';
                                    }
                                    break;
                                case 2:
                                    if (ProductSpecificationDAO::update($connection_db, $product_spec_->getId(), null, $filesavedname, null, null, null, null, null, null)) {
                                        move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                                        $message = 'product successfuly saved!';
                                        $success = true;
                                    } else {
                                        $message = 'can not update product image! error ocured!';
                                    }
                                    break;
                                default :
                                    if (ProductSpecificationDAO::update($connection_db, $product_spec_->getId(), null, null, $filesavedname, null, null, null, null, null)) {
                                        move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                                        $message = 'product successfuly saved!';
                                        $success = true;
                                    } else {
                                        $message = 'can not update product image! error ocured!';
                                    }
                                    break;
                            }
                        } else {
                            $message = " no product spec found!";
                        }
                    }
                }
            }
        } else {
            $message = " invalid image type or size!";
        }
    } else {
        $message = " no product found for the request!";
    }
} else {
    $message = " no valid image found!";
}




//json responce
$response["data"] = array("success" => $success, "message" => $message);
$json = json_encode($response, JSON_FORCE_OBJECT);
echo $json;
?>
