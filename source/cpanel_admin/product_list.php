<?php
session_start();

class webpage_interface_info {

    //information aboutn webpage
    private $_inf_name = 'product_list';
    private $_inf_code = 'PLCPL_10200';
    private $_inf_url = 'cpanel/product_list.php';
    private $_interface_user_access_level = "NORMAL_ADMIN";

    public function getInfData() {
        return array("_inf_code" => $this->_inf_code, "_inf_name" => $this->_inf_name, "_inf_url" => $this->_inf_url, "_interface_user_access_level" => $this->_interface_user_access_level);
    }

}

if (!isset($_SESSION['user'])) {
    echo '<script>
  window.location.href = "login.php";
  </script>';
} else {
    //check user has privilages
    $_inf_info = new webpage_interface_info();
    $useraccount_arr = $_SESSION['user_account'];
    if ($useraccount_arr["_iduser_role"] == 3 || $useraccount_arr["_iduser_role"] == 4) {

//Document Root Path
        $document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
//online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
        require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';
//sub inclued files
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/connection/db_conn.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Product.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Common.php';


        $connection_db = new db_conn();
        ?>
        ﻿<!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>DashBoard</title>
                <!-- BOOTSTRAP STYLES-->
                <!--<link href="assets/css/bootstrap.css" rel="stylesheet" />-->
                <!-- FONTAWESOME STYLES-->
                <link href="assets/css/font-awesome.css" rel="stylesheet" />
                <!-- CUSTOM STYLES-->
                <link href="assets/css/custom.css" rel="stylesheet" />
                <!-- GOOGLE FONTS-->
                <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
                <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
                <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" type="text/css" rel="stylesheet"/>


            </head>

            <body>
                <div id="wrapper">
                    <?php include_once './inclueds/top.php'; ?>
                    <!-- /. NAV TOP  -->
                    <?php include_once './inclueds/left_nav.php'; ?>
                    <!-- /. NAV SIDE  -->
                    <div id="page-wrapper" >
                        <div id="page-inner">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Product</h2>   
                                </div>
                            </div>              
                            <!-- /. ROW  -->
                            <hr />
                            <!--<PAGE CONTENT>===================================-->
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <a class="btn btn-default" href="add_new_product.php"> <span class="glyphicon glyphicon-plus"></span> Add Product</a>
                                            <a class="btn btn-default" href="manage_product_category.php"> <span class="glyphicon glyphicon-plus"></span> Add Category</a>
                                            <a class="btn btn-default" href="manage_product_brand.php"> <span class="glyphicon glyphicon-plus"></span> Add Brand</a>
                                            <a class="btn btn-default" href="manage_offers.php"> <span class="glyphicon glyphicon-plus"></span> Add Offers</a>
                                            <!--<a class="btn btn-default" href="#">Manage Product</a>-->
                                        </div>
                                        <!--                                        <div class="col-md-4">
                                                                                    <div class="input-group">
                                                                                        <input type="text" name="search_product" placeholder="Search for..." class="form-control" />
                                                                                        <span class="input-group-addon">GO!</span>
                                                                                    </div>
                                                                                </div>-->
                                    </div>
                                    <br/><br/>
                                    <table id="productlist_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <!--<th>#</th>-->
                                                <th>img</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Retail</th>
                                                <th>Whole</th>
                                                <th>Dealer</th>
                                                <th>Ctrl.</th>
                                                <th>Featured</th>
                                                <th>Status</th>
                                                <th>type</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $plist = ProductDAO::listByQuery($connection_db, null, null);
                                            foreach ($plist as $ob) {
                                                ?>
                                                <tr>
                                                    <!--<td><?//php echo $ob->getId(); ?></td>-->
                                                    <td>
                                                        <img src="
                                                        <?php
                                                        if ($ob->getImg_name() == "") {
                                                            echo '../product_images/no_image_avl_i.png';
                                                        } else {
                                                            echo '../product_images/' . $ob->getImg_name();
                                                        }
                                                        ?>" width="80px" height="50px;">
                                                    </td>
                                                    <td><?php echo $ob->getName(); ?></td>
                                                    <td><button class="btn btn-xs btn-default"><?php echo $ob->getBrand_obj()->getName(); ?></button></td>
                                                    <td><button class="btn btn-xs btn-warning pull-right"><?php echo number_format($ob->getRetail_price(), 2); ?></button></td>
                                                    <td><button class="btn btn-xs btn-warning pull-right"><?php echo number_format($ob->getWholesale_price(), 2); ?></button></td>
                                                    <td><button class="btn btn-xs btn-warning pull-right"><?php echo number_format($ob->getDealer_price(), 2); ?></button></td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td><a onclick="removeProduct(<?php echo $ob->getId(); ?>)" class="btn btn-danger btn-xs">del.</a></td>
                                                                <td ><a style="margin-left: 10px;" href="product_management.php?pid=<?php echo $ob->getId(); ?>" class="btn btn-info btn-xs pull-right">mng.</a></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($ob->getIs_featured()) {
                                                            echo "<a onclick='changeproductfeaturedstatus({$ob->getId()},{$ob->getIs_featured()});' class='btn btn-danger btn-xs'>remove</a>";
                                                        } else {
                                                            echo "<a onclick='changeproductfeaturedstatus({$ob->getId()},{$ob->getIs_featured()});' class='btn btn-primary btn-xs '>add</a>";
                                                        }
                                                        ?>

                                                    </td>
                                                    <td><?php
                                                        if ($ob->getStatus()) {
                                                            ?>
                                                            <a onclick="updateProductStatus('<?php echo $ob->getId() ?>', '0')" class="btn btn-xs btn-success">active</a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a onclick="updateProductStatus('<?php echo $ob->getId() ?>', '1')" class="btn btn-xs btn-danger">inactive</a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($ob->getProduct_type() == 1) {
                                                            ?>
                                                            <a class="btn btn-xs btn-primary">Brand New</a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a class="btn btn-xs btn-warning">Used</a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <!--<END PAGE CONTENT>===================================-->
                            <!-- /. ROW  --> 
                        </div>
                        <!-- /. PAGE INNER  -->
                    </div>
                    <!-- /. PAGE WRAPPER  -->
                </div>
                <?php include_once './inclueds/footer.php'; ?>


                <!-- /. WRAPPER  -->
                <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
                <!-- JQUERY SCRIPTS -->
                <!--<script src="assets/js/jquery-1.10.2.js"></script>-->
                <script src="//code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
                <!-- BOOTSTRAP SCRIPTS -->
                <script src="assets/js/bootstrap.min.js"></script>
                <!-- CUSTOM SCRIPTS -->
                <script src="assets/js/custom.js"></script>
                <script src="../scripts/json_action.js"></script>
                <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" type="text/javascript" ></script>
                <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js" type="text/javascript" ></script>


                <script type="text/javascript">
                                                        $(document).ready(function () {
                                                            $('#productlist_table').DataTable();
                                                        });
                </script>


            </body>
        </html>
        <?php
    } else {
        echo '<script>
  window.location.href = "../error_pages/unauthorized.php";
  </script>';
    }
}
?>