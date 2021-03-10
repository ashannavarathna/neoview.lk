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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductCategoryDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSubCategoryDAO.php';


$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}


if (isset($_REQUEST['action'])) {

    $action = $_REQUEST['action'];
    $id = $_REQUEST['id'];
    
    if ($action == 'getProductSubCatList') {
        $dataarr = array();
        $list = ProductSubCategoryDAO::listByQuery($connection_db, " product_category_idproduct_category='{$id}'", null);
        foreach ($list as $ob) {
            $dataarr[] = ['id' => $ob->getId(), 'value' => $ob->getName()];
        }
        echo json_encode($dataarr);
    }
}
?>
