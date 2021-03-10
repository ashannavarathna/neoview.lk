<?php

//Document Root Path
$document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
//echo $document_root . '/__rootaccess_prams.php';
//
//online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';

//sub inclued files
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Times.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserAccount.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserAccountDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserAddress.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserAddressDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/connection/db_conn.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserGenderDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/BrandDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSpecificationDAO.php';


$connection_db = new db_conn();

echo ProductSpecificationDAO::save($connection_db, null, null, null, null, null, null, '0000-00-00', 3);
?>

