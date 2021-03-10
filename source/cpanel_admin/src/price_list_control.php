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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/PriceListCategoryDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/PriceListImagesDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Times.php';
$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}

//json data set
$success = false;
$message = 'server_messages => no from submitted!';
$response = array();

$FLASGSAVE = false;
$FLAGUPDATE = false;
$FLAGDOSAVEIMAGE = false;
$IMAGEPATH = '';
$IMAGENAME = null;

$FLAGIMAGESAVED = false;
$FLAGISCAT = false;
$FLAGISPLIST = false;

$CATNAME = null;
$CATID = null;


if ($_POST['EntryType'] == "NEW") {
    $message = "To create a new entry ";

    if ($_FILES["file"]['type'] != null) {
        $FLASGSAVE = true;
        $FLAGDOSAVEIMAGE = true;
    } else {
        $message .= " image must be uploaded!";
    }

    if ($_POST['SubmitType'] == 'PRSLSTCATEGROY') {
        if ((empty(trim($_POST['catname'])))) {
            $FLASGSAVE = false;
            $message .= " , category name can not be empty!";
        } else {
            $CATNAME = $_POST['catname'];
        }
    }

    if ($_POST['SubmitType'] == 'PRSLST') {
        if ((empty(trim($_POST['idpricelstcat'])))) {
            $FLASGSAVE = false;
            $message .= " , category must be selected!";
        } else {
            $CATID = $_POST['idpricelstcat'];
        }
    }
}

if ($_POST['EntryType'] == 'UPDATE') {
    $FLAGUPDATE = true;
    if ($_FILES["file"]['type'] != null) {
        $FLAGDOSAVEIMAGE = true;

        if ($_POST['SubmitType'] == 'PRSLSTCATEGROY') {
            if (!(empty(trim($_POST['catname'])))) {
                $CATNAME = $_POST['catname'];
            }
        }

        if ($_POST['SubmitType'] == 'PRSLST') {
            if (!(empty(trim($_POST['idpricelstcat'])))) {
                $CATID = $_POST['idpricelstcat'];
            }
        }
    } else {
        $message = "To update a entry image or ";
        if ($_POST['SubmitType'] == 'PRSLSTCATEGROY') {
            if ((empty(trim($_POST['catname'])))) {
                $FLAGUPDATE = false;
                $message .= " , category name can not be empty!";
            } else {
                $CATNAME = $_POST['catname'];
            }
        }

        if ($_POST['SubmitType'] == 'PRSLST') {
            if ((empty(trim($_POST['idpricelstcat'])))) {
                $FLAGUPDATE = false;
                $message .= " , category must be selected!";
            } else {
                $CATID = $_POST['idpricelstcat'];
            }
        }
    }
}


if ($_POST['SubmitType'] == 'PRSLSTCATEGROY') {
    $FLAGISCAT = true;
    $IMAGEPATH = "/product_images/price_list/list_headers/";
}

if ($_POST['SubmitType'] == 'PRSLST') {
    $FLAGISPLIST = true;
    $IMAGEPATH = "/product_images/price_list/";
}

if ($FLAGDOSAVEIMAGE && ($FLASGSAVE || $FLAGUPDATE)) {

    //SAVING IMAGE
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
            ) && ($_FILES["file"]["size"] < 500000)//Approx. 500kb files can be uploaded.
            && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            $message = "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            $imgname = md5(Times::getFullTime());
            //                        $_FILES["file"]["name"];
            $filesavedname = $imgname . '.' . $file_extension;
            if (file_exists(__rootaccess_prams::$__upload_dir . $IMAGEPATH . $filesavedname)) {
                $message = $_FILES["file"]["name"] . " already exists => " . $filesavedname;
            } else {
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $targetPath = __rootaccess_prams::$__upload_dir . $IMAGEPATH . $filesavedname; // Target path where file is to be stored

                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                $FLAGIMAGESAVED = true;
                $IMAGENAME = $filesavedname;
//                $message = "img saved : " . $IMAGENAME . " > path : " . __rootaccess_prams::$__upload_dir . $IMAGEPATH;
            }
        }
    } else {
        $message = " invalid image type or size!";
    }
}


if ($FLAGISCAT && $FLASGSAVE && $FLAGIMAGESAVED) {
    // save new category entry
    if (PriceListCategoryDAO::save($connection_db, $CATNAME, $IMAGENAME)) {
        $success = true;
        $message = "Price list category saved!";
    } else {
        $message = "Can not save price list category!";
    }
}
if ($FLAGISCAT && $FLAGUPDATE) {
    //update a category entry
//    $message = PriceListCategoryDAO::update($connection_db, $_POST['ctid'], $CATNAME, $IMAGENAME);
    if (PriceListCategoryDAO::update($connection_db, $_POST['ctid'], $CATNAME, $IMAGENAME)) {
        $success = true;
        $message = "Price list category updated!";
    } else {
        $message = "Can not update price list category!";
    }
}
if ($FLAGISPLIST && $FLASGSAVE && $FLAGIMAGESAVED) {
    //save new list entry
    if (PriceListImagesDAO::save($connection_db, $IMAGENAME, $CATID)) {
        $success = true;
        $message = "Price list image entry saved!";
    } else {
        $message = "Can not save price list image entry!";
    }
}
if ($FLAGISPLIST && $FLAGUPDATE) {
    // update new list entry
//    $message = PriceListImagesDAO::update($connection_db, $_POST['id'], $IMAGENAME, $CATID);
    if (PriceListImagesDAO::update($connection_db, $_POST['id'], $IMAGENAME, $CATID)) {
        $success = true;
        $message = "Price list image entry updated!";
    } else {
        $message = "Can not update price list image entry!";
    }
}









//json responce
$response["data"] = array("success" => $success, "message" => $message);
$json = json_encode($response, JSON_FORCE_OBJECT);
echo $json;
?>
