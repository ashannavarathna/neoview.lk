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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSpecificationDAO.php';

$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Product Details </title>
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
        <link href="css/custom_style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php include_once './includes/header.php'; ?>
        <!-- Header End====================================================================== -->
        <div id="mainBody">
            <div class="container">
                <div class="row">
                    <!-- Sidebar ================================================== -->
                    <div id="sidebar" class="span3">
                        <?php include_once './includes/left_menu_full.php'; ?>
                    </div>
                    <!-- Sidebar end=============================================== -->
                    <div class="span9">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                            <li><a href="products.php">Products</a> <span class="divider">/</span></li>
                            <li class="active">product Details</li>
                        </ul>	
                        <div class="row">
                            <?php
                            //handler code for if no param values pass to page
                            if (empty(trim($_GET['pid']))) {
                                //return back to index page
                                echo "  <script> window.location.href = 'index.php' </script>";
                                die();
                            } else {
                                // getting param values for selected product object
                                $pid = trim($_GET['pid']);

                                //handler code for product object check
                                $product_ = ProductDAO::getByQuery($connection_db, " idproduct='{$pid}' and status='1'", null);
                                if ($product_ == null) {
                                    //if no prodcut associate with pid retun back to index
                                    echo "  <script> window.location.href = 'index.php'</script>";
                                    die();
                                }
                                //end handler ==========>
                                // add handler code here :  to check product status active 
                                // 
                                // 
                                // 
                                //end active handler code
                                //handler for product spec
                                $product_spec_ = ProductSpecificationDAO::getByQuery($connection_db, " product_idproduct='{$product_->getId()}'", null);
                                //end handler ===================>
                                //hanlder code for product spec object
                                if ($product_spec_ == null) {
                                    //if no prodcut spec avl.
                                    echo "  <script> window.location.href = 'index.php'</script>";
                                    die();
                                }
                                //enh handler =====================>
                                ?>
                                <div id="gallery" class="span3">
                                    <?php
                                    $defaultimagename = "no_image_avl_i.png";
                                    if ($product_->getImg_name() != "") {
                                        $defaultimagename = $product_->getImg_name();
                                    }
                                    ?>
                                    <a href="<?php echo __rootaccess_prams::$__upload_dir . $defaultimagename; ?>" title="<?php echo $product_->getBrand_obj()->getName() . " " . $product_->getName() ?>">
                                        <img src="<?php echo __rootaccess_prams::$__upload_dir . $defaultimagename ?>" style="width:100%" alt="<?php echo $product_->getBrand_obj()->getName() . " " . $product_->getName() ?>"/>
                                    </a>
                                    <div id="differentview" class="moreOptopm carousel slide">
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <a href="<?php echo __rootaccess_prams::$__upload_dir . $defaultimagename ?>"> <img style="width:29%" src="<?php echo __rootaccess_prams::$__upload_dir . $defaultimagename ?>" alt=""/></a>
                                                <!--<a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>-->
                                                <!--<a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>-->
                                            </div>
                                            <div class="item">
                                                <a href="<?php echo __rootaccess_prams::$__upload_dir . $defaultimagename?>" > <img style="width:29%" src="<?php echo __rootaccess_prams::$__upload_dir . $defaultimagename ?>" alt=""/></a>
                                                <!--<a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>-->
                                                <!--<a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>-->
                                            </div>
                                        </div>
                                        <!--  
                                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                                        <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
                                        -->
                                    </div>

                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <span class="btn"><i class="icon-envelope"></i></span>
                                            <span class="btn" ><i class="icon-print"></i></span>
                                            <span class="btn" ><i class="icon-zoom-in"></i></span>
                                            <span class="btn" ><i class="icon-star"></i></span>
                                            <span class="btn" ><i class=" icon-thumbs-up"></i></span>
                                            <span class="btn" ><i class="icon-thumbs-down"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <h3><?php echo $product_->getBrand_obj()->getName() . " " . $product_->getName(); ?> </h3>
                                    <small>- <?php echo $product_->getDescription(); ?></small>
                                    <hr class="soft"/>
                                    <h4>Prices : dealer, wholesale, Retail </h4>
                                    <form class="form-horizontal qtyFrm">
                                        <div class="control-group">
                                            <div class="controls">
                                                <button class="btn btn-small btn-primary pull-right" style="margin-left: 10px;"> <?php echo number_format($product_->getRetail_price(), 2); ?> <i class=" icon-money "></i></button>
                                                <button class="btn btn-small btn-info pull-right" style="margin-left: 10px;" >  <?php echo number_format($product_->getWholesale_price(), 2); ?> <i class=" icon-money"></i></button>
                                                <button class="btn btn-small btn-warning pull-right" style="margin-left: 10px;">  <?php echo number_format($product_->getDealer_price(), 2); ?> <i class=" icon-money "></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr class="soft"/>

                                    <p>
                                        <?php echo $product_spec_->getLong_description(); ?>
                                    </p>
                                    <a class="btn btn-small pull-right" href="#detail">More Details</a>
                                    <br class="clr"/>
                                    <a href="#" name="detail"></a>
                                    <hr class="soft"/>
                                </div>

                                <div class="span9">
                                    <ul id="productDetail" class="nav nav-tabs">
                                        <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                                        <li><a href="#profile" data-toggle="tab">Related Products</a></li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane fade active in" id="home">
                                            <h4>Product Information</h4>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                                                    <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2"><?php echo $product_->getBrand_obj()->getName(); ?></td></tr>
                                                    <tr class="techSpecRow"><td class="techSpecTD1">Model:</td><td class="techSpecTD2"><?php echo $product_spec_->getProduct_model(); ?></td></tr>
                                                    <tr class="techSpecRow"><td class="techSpecTD1">Released on:</td><td class="techSpecTD2"> <?php echo $product_spec_->getReleased_on(); ?></td></tr>
                                                    <tr class="techSpecRow"><td class="techSpecTD1">Product Type:</td><td class="techSpecTD2"> <?php if($product_->getProduct_type() == 1){echo 'Brand New';}else{echo 'Used';} ?></td></tr>
                                                    <!--<tr class="techSpecRow"><td class="techSpecTD1">Display size:</td><td class="techSpecTD2">3</td></tr>-->
                                                </tbody>
                                            </table>

                                            <h5>Features</h5>
                                            <p>
                                                <?php echo $product_spec_->getProduct_features(); ?>
                                            </p>


                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <div id="myTab" class="pull-right">
                                                <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
                                                <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                                            </div>
                                            <br class="clr"/>
                                            <hr class="soft"/>
                                            <div class="tab-content">
                                                <div class="tab-pane" id="listView">
                                                    <?php
                                                    $result = $connection_db->query("SELECT * FROM product WHERE is_featured='0' and status='1'  and product_sub_category_idproduct_sub_category='{$product_->getProduct_sub_category_obj()->getId()}' and idproduct != '{$product_->getId()}' ORDER BY idproduct DESC LIMIT 6");
                                                    while ($row = mysql_fetch_array($result)) {
                                                        ?>
                                                        <div class="row">	  
                                                            <div class="span2">
                                                                <img src="
                                                                <?php
                                                                if ($row['img_name'] == "") {
                                                                    echo __rootaccess_prams::$__upload_dir . 'no_image_avl_i.png';
                                                                } else {
                                                                    echo __rootaccess_prams::$__upload_dir . $row['img_name'];
                                                                }
                                                                ?>" alt=""/>
                                                            </div>
                                                            <div class="span4">
                                                                <h3>New | Available</h3>				
                                                                <hr class="soft"/>
                                                                <h5><?php echo $row['name']; ?> </h5>
                                                                <p>
                                                                    <?php echo $row['description']; ?>
                                                                </p>
                                                                <a class="btn btn-small pull-right" href="product_details.php?pid=<?php echo $row['idproduct'] ?>">View Details</a>
                                                                <br class="clr"/>
                                                            </div>
                                                            <div class="span3 alignR">
                                                                <form class="form-horizontal qtyFrm">
                                                                    <h3> <?php echo number_format($row['retail_price'], 2) ?></h3>
                                                                    <!--                                                                    <label class="checkbox">
                                                                                                                                            <input type="checkbox">  Adds product to compair
                                                                                                                                        </label><br/>-->
                                                                    <div class="btn-group">
                                                                        <!--<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>-->
                                                                        <!--<a href="product_details.php?pid=" class="btn btn-large"><i class="icon-zoom-in"></i></a>-->
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <hr class="soft"/>
                                                    <?php }
                                                    ?>

                                                </div>
                                                <div class="tab-pane active" id="blockView">
                                                    <ul class="thumbnails">
                                                        <?php
                                                        $result = $connection_db->query("SELECT * FROM product WHERE is_featured='0' and status='1' and product_sub_category_idproduct_sub_category='{$product_->getProduct_sub_category_obj()->getId()}' and idproduct != '{$product_->getId()}' ORDER BY idproduct DESC LIMIT 6");
                                                        while ($row = mysql_fetch_array($result)) {
                                                            echo "<li class='span3'>";
                                                            echo "<div class='thumbnail'>";
                                                            if ($row['img_name'] == "") {
                                                                echo "<a  href='#' ><img id='showcase_block_grid_view_image' src=' " . __rootaccess_prams::$__upload_dir . "no_image_avl_i.png ' alt=''/></a>";
                                                            } else {
                                                                echo "<a  href='#' ><img id='showcase_block_grid_view_image' src=' " . __rootaccess_prams::$__upload_dir . $row['img_name'] . "' alt=''/></a>";
                                                            }
                                                            echo "<div class='caption'>";
                                                            echo "<h5>" . $row['name'] . "</h5>";
                                                            echo "<p> " . $row['description'] . "</p>";
                                                            echo "<h4 style='text-align:center'><a class='btn' href='product_details.php?pid=" . $row['idproduct'] . "'> <i class='icon-zoom-in'></i></a> <a class='btn hidden' href='#'>Add to <i class='icon-shopping-cart'></i></a> <a class='btn btn-primary' href='#'>" . number_format($row['retail_price'], 2) . "</a></h4>";
                                                            echo "</div>";
                                                            echo " </div>";
                                                            echo "</li>";
                                                        }
                                                        ?>
                                                    </ul>
                                                    <hr class="soft"/>
                                                </div>
                                            </div>
                                            <br class="clr">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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