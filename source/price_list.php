<?php
session_start();
//Document Root Path
$document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
//online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';
//sub inclued files
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/connection/db_conn.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/PriceListCategoryDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/PriceListImagesDAO.php';

$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Price List </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--Less styles -->
        <!-- Other Less css file //different less files has different color scheam
             <link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
             <link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
             <link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
        -->
        <!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
        <script src="themes/js/less.js" type="text/javascript"></script> -->

        <!-- Bootstrap style --> 
        <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
        <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
        <!-- Bootstrap style responsive -->	
        <link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
        <link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
        <!-- Google-code-prettify -->	
        <link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
        <!-- fav and touch icons -->
        <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
        <style type="text/css" id="enject"></style>
        <!-- form validation ============== -->
        <link rel="stylesheet" href="css/validation.form.css" type="text/css"/>
    </head>
    <body>
        <?php include_once './includes/header.php'; ?>
        <!-- Header End====================================================================== -->
        <div id="mainBody">
            <div class="container">
                <div class="row">
                    <!-- Sidebar ================================================== -->
                    <div id="sidebar" class="span3">
                        <!--?php include_once './includes/left_menu_full.php'; ?-->
                    </div>
                    <!-- Sidebar end=============================================== -->
                    <div style="width: 1000px; margin: 0 auto;">
                        <ul class="nav nav-tabs">
                            <?php
                            $price_list_category = PriceListCategoryDAO::listByQuery($connection_db, null, null);
                            $active_index = true;
                            foreach ($price_list_category as $ob1) {
                                if ($active_index) {
                                    $active_index = false;
                                    ?>
                                    <li  class="active"><a data-toggle="tab" href="#<?php echo $ob1->getName(); ?>"><img src="product_images/price_list/list_headers/<?php echo $ob1->getImage_name(); ?>" style="width: 120px; height: 50px;" alt="<?php echo $ob1->getName() ?>"></a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a data-toggle="tab" href="#<?php echo $ob1->getName(); ?>"><img src="product_images/price_list/list_headers/<?php echo $ob1->getImage_name(); ?>" style="width: 120px; height: 50px;" alt="<?php echo $ob1->getName() ?>"> </a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>

                        <div class="tab-content">
                            <?php
                            $active_index_2 = true;
                            foreach ($price_list_category as $ob2) {
                                if ($active_index_2) {
                                    $active_index_2 = false;
                                    echo '<div  id="' . $ob2->getName() . '" class="tab-pane fade in active">';
                                    echo '<h3>' . $ob2->getName() . ' Price List</h3>';
                                    $lst = PriceListImagesDAO::listByQuery($connection_db, " price_list_category_idprice_list_category='{$ob2->getId()}'", null);
                                    foreach ($lst as $oo) {
                                        echo "<img src='product_images/price_list/{$oo->getImage_name()}' width='800px' /> <br/><br/>";
                                    }
                                    echo '</div>';
                                } else {
                                    echo '<div  id="' . $ob2->getName() . '" class="tab-pane fade in ">';
                                    echo '<h3>' . $ob2->getName() . ' Price List</h3>';
                                    $lst = PriceListImagesDAO::listByQuery($connection_db, " price_list_category_idprice_list_category='{$ob2->getId()}'", null);
                                    foreach ($lst as $oo) {
                                        echo "<img src='product_images/price_list/{$oo->getImage_name()}' width='800px' /> <br/><br/>";
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- MainBody End ============================= -->
        <!-- Footer ================================================================== -->
        <?php include_once './includes/footer_section.php'; ?>
        <!-- Placed at the end of the document so the pages load faster ============================================= -->
        <script src="themes/js/jquery.js" type="text/javascript"></script>
        <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="themes/js/google-code-prettify/prettify.js"></script>

        <!--<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
        <!--<script src="js/jquery.validate.min.js" type="text/javascript"></script>-->
        <!--<script src="js/additional-methods.min.js" type="text/javascript"></script>-->


        <script src="themes/js/bootshop.js"></script>
        <script src="themes/js/jquery.lightbox-0.5.js"></script>

        <!-- Page Scriptis===================================== -->



    </body>
</html>