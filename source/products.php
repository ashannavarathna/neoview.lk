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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSubCategoryDAO.php';

$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Prodcuts </title>
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
        <style type="text/css">
            #curnt_btn{
                background-color: #333333;
                color: #FFF;
            }
        </style>

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
                            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                            <li class="active">Products</li>
                        </ul>

                        <?php
                        $subcc_prd_id;
                        $srch_name_prd;
                        if (isset($_REQUEST['subcc__prd_id']) && !empty(trim($_REQUEST['subcc__prd_id']))) {
                            $subcc_prd_id = $_REQUEST['subcc__prd_id'];
                            $subprdob = ProductSubCategoryDAO::getByQuery($connection_db, " idproduct_sub_category='{$subcc_prd_id}'", null);

                            echo "<h3> PRODUCTS : " . strtoupper($subprdob->getName()) . " <small class='pull-right'>  </small></h3>";
                        } else {
                            echo "<h3> PRODUCTS : ALL <small class='pull-right'>  </small></h3>";
                        }
                        ?>

                        <hr class="soft"/>
<!--                        <p>
                            Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - that is why our goods are so popular and we have a great number of faithful customers all over the country.
                        </p>-->
                        <!--<hr class="soft"/>-->


                        <?php
                        $query = " SELECT * FROM product WHERE status='1' ";
                        if (isset($subcc_prd_id)) {
                            $query .= " and product_sub_category_idproduct_sub_category='{$subcc_prd_id}' ";
                        }
                        if (isset($_REQUEST['srch__name_prd']) && !empty(trim($_REQUEST['srch__name_prd']))) {
                            $query .= " and name like '%{$_REQUEST['srch__name_prd']}%' ";
                        }
                        $query .= " ORDER BY idproduct DESC";


                        $result_misql = $connection_db->query($query);
                        $result_allproduct_list = array();
                        while ($row = mysql_fetch_array($result_misql)) {
                            $result_allproduct_list[] = $row;
                        }

                        $totalproduct_size = count($result_allproduct_list);


                        $_begin_index = 0; // begin index value
                        $_items_per_page = 18;
                        $_offset = 0;
                        $_page_num = 0;
                        //check page number val
                        if (isset($_REQUEST['page_num']) && !empty(trim($_REQUEST['page_num']))) {
                            $_page_num = $_REQUEST['page_num'];
                            $_offset = $_items_per_page * $_page_num;
                        } else {
                            $_offset = 0;
                        }

//                        $_pagination_button_count = ;
                        $_pagination_button_count = round(($totalproduct_size / $_items_per_page), 0, PHP_ROUND_HALF_DOWN);

//                        echo 'count : ' . $_pagination_button_count . ' total pro : ' . $totalproduct_size . ' > <br/>';
                        if ($totalproduct_size % $_items_per_page == 0) {
                            $_pagination_button_count = $_pagination_button_count - 1;
                        }
//                        echo 'div: ' . ($totalproduct_size / $_items_per_page) . ' mod : ' . ($totalproduct_size % $_items_per_page) . ' > <br/>';
                        ?>

                        <?php
                        if ($totalproduct_size === 0) {
                            echo 'No product availabel!';
                        }
                        ?>

                        <div id="myTab" class="pull-right">
                            <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
                            <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                        </div>

                        <br class="clr"/>
                        <br/>
                        <div class="tab-content">
                            <div class="tab-pane" id="listView">
                                <?php
                                $result = $connection_db->query($query . " LIMIT {$_offset} , {$_items_per_page}");
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
                                    $result = $connection_db->query($query . " LIMIT {$_offset} , {$_items_per_page}");
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<li class='span3'>";
                                        echo "<div class='thumbnail'>";
                                        if ($row['img_name'] == "") {
                                            echo "<a  href='#' ><img id='showcase_block_grid_view_image' src=' " . __rootaccess_prams::$__upload_dir . "no_image_avl_i.png ' alt=''/></a>";
                                        } else {
                                            echo "<a  href='#' ><img id='showcase_block_grid_view_image' src=' " . __rootaccess_prams::$__upload_dir . $row['img_name'] . "' alt=''/></a>";
                                        }
                                        echo "<div class='caption'>";
                                        echo "<h5 id='showcase_block_name'>" . $row['name'] . "</h5>";
                                        echo "<p style='height:30px;overflow:hidden;'> " . $row['description'] . "</p>";
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

                        <div class="pagination">
                            <ul>
                                <?php
                                if ($_page_num > 0) {
//                                    $_page_num = $_page_num - 1;
                                    if (isset($subcc_prd_id)) {
                                        echo "<li><a href='products.php?subcc__prd_id={$subcc_prd_id}&page_num=" . ($_page_num - 1) . "'>&lsaquo;</a></li>";
                                    } else {
                                        echo "<li><a href='products.php?page_num=" . ($_page_num - 1) . "'>&lsaquo;</a></li>";
                                    }
                                } else {
                                    echo "<li style='pointer-events: none;opacity: 0.6; '><a href='#' >&lsaquo;</a></li>";
                                }

                                for ($j = 0; $j <= $_pagination_button_count; $j++) {
                                    if ($j == $_page_num) {
                                        if (isset($subcc_prd_id)) {
                                            echo "<li ><a style='background-color:#9A9A9A;color:#FFF;' href='products.php?subcc__prd_id={$subcc_prd_id}&page_num={$j}'>" . ($j + 1) . "</a></li>";
                                        } else {
                                            echo "<li ><a style='background-color:#9A9A9A;color:#FFF;' href='products.php?page_num={$j}'>" . ($j + 1) . "</a></li>";
                                        }
                                    } else {
                                        if (isset($subcc_prd_id)) {
                                            echo "<li><a href='products.php?subcc__prd_id={$subcc_prd_id}&page_num={$j}'>" . ($j + 1) . "</a></li>";
                                        } else {
                                            echo "<li><a href='products.php?page_num={$j}'>" . ($j + 1) . "</a></li>";
                                        }
                                    }
                                }
                                if ($_page_num < $_pagination_button_count) {
//                                    $_page_name = $_page_num + 1;
                                    if (isset($subcc_prd_id)) {
                                        echo "<li><a href='products.php?subcc__prd_id={$subcc_prd_id}&page_num=" . ($_page_num + 1) . "'>&rsaquo;</a></li>";
                                    } else {
                                        echo "<li><a href='products.php?page_num=" . ($_page_num + 1) . "'>&rsaquo;</a></li>";
                                    }
                                } else {
                                    echo "<li style='pointer-events: none;opacity: 0.6; '><a href='#' >&rsaquo;</a></li>";
                                }
                                ?>

                            </ul>
                        </div>
                        <br class="clr"/>
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