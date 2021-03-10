<?php
session_start();

class webpage_interface_info {

    //information aboutn webpage
    private $_inf_name = 'add_new_product';
    private $_inf_code = 'adpCPL_10203';
    private $_inf_url = 'cpanel/add_new_product.php';
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
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Offers.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Brand.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ProductCategory.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/ProductSubCategory.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/OffersDAO.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/BrandDAO.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductCategoryDAO.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSubCategoryDAO.php';
//cehck for data

        $connection_db;
        if (!isset($connection_db)) {
            $connection_db = new db_conn();
        }
        ?>

        ﻿<!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>prodcut register</title>
                <!-- BOOTSTRAP STYLES-->
                <link href="assets/css/bootstrap.css" rel="stylesheet" />
                <!-- FONTAWESOME STYLES-->
                <link href="assets/css/font-awesome.css" rel="stylesheet" />
                <!-- CUSTOM STYLES-->
                <link href="assets/css/custom.css" rel="stylesheet" />
                <!-- GOOGLE FONTS-->
                <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
                <link rel="stylesheet" href="../css/validation.form.css" type="text/css"/>
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
                                    <h2>Product Registration</h2>   
                                </div>
                            </div>              
                            <!-- /. ROW  -->
                            <hr />
                            <!--<PAGE CONTENT>===================================-->
                            <div class="row">
                                <div class="col-md-5">
                                    <h5>Product Details</h5>
                                    <form id="uploadimage" method="POST" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="pcode" class="form-control" placeholder="Product Code" />
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="pname" id="pname" class="form-control" placeholder="Product Name" />
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <select class="form-control" name="pbrand">
                                                <option value="">-Select Brand-</option>
                                                <?php
                                                $olist = BrandDAO::listByQuery($connection_db, null, null);
                                                foreach ($olist as $ob_) {
                                                    echo "<option value='{$ob_->getId()}'>{$ob_->getName()}</option>";
                                                }
                                                unset($olist);
                                                unset($ob_)
                                                ?>

                                            </select>
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <select class="form-control" id="pcategory" name="pcategory" onchange="getProductSubCatByProductCatId();">
                                                <option value="">-Select Category-</option>
                                                <?php
                                                $olist = ProductCategoryDAO::listByQuery($connection_db, null, null);
                                                foreach ($olist as $ob_) {
                                                    echo "<option value='{$ob_->getId()}'>{$ob_->getName()}</option>";
                                                }
                                                unset($olist);
                                                unset($ob_)
                                                ?>
                                            </select>
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <select class="form-control" id="psubcategory" name="psubcategory">
                                                <option value="">-Select Sub Category-</option>

                                            </select>
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <select class="form-control" id="poffers" name="poffers">
                                                <option value="">-Select Offers-</option>
                                                <?php
                                                $olist = OffersDAO::listByQuery($connection_db, null, null);
                                                foreach ($olist as $ob_) {
                                                    echo "<option value='{$ob_->getId()}'>{$ob_->getName()}</option>";
                                                }
                                                unset($olist);
                                                unset($ob_)
                                                ?>
                                            </select>
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <select class="form-control" id="ptype" name="ptype">
                                                <option value="">-Select Type-</option>
                                                <option value="1">Brand New</option>
                                                <option value="2">Used</option>
                                            </select>
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="pretail_price" class="form-control" placeholder="Retails Price" />
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="pwholesale_price" class="form-control" placeholder="Whole Sale Price" />
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="pdealer_price" class="form-control" placeholder="Dealer Price" />
                                        </div>
                                        <br/>
                                        <div class="input-group" style="" >
                                            <span class="input-group-addon">:)</span>
                                            <input type="file" name="file" id="file" class="form-control" title="select product image"  />
                                        </div>
                                        <br/>
                                        <div class="input-group" style="" >
                                            <span class="input-group-addon">:)</span>
                                            <textarea class="form-control" name="pdescription" id="pdescription" required rows="4" placeholder="information about this product..." ></textarea>
                                        </div>
                                        <br />
                                        <div class="input-group pull-right">
                                            <input type="hidden" name="action" value="saveProduct"/>
                                            <input type="submit" value="SAVE" class="btn btn-success pull-right" style="width: 150px;"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-block  fade in hidden" id="submit_alert_box">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <span id="from_data_submit_msg"><strong>SERVER :  </strong> </span>
                                    </div>
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
                <script src="assets/js/jquery-1.10.2.js"></script>
                <!-- BOOTSTRAP SCRIPTS -->
                <script src="assets/js/bootstrap.min.js"></script>
                <!-- CUSTOM SCRIPTS -->
                <script src="assets/js/custom.js"></script>
                <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
                <!--<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>-->
                <script src="../js/jquery.validate.min.js" type="text/javascript"></script>
                <script src="../js/additional-methods.min.js" type="text/javascript"></script>
                <script src="./scripts/prodcut_handler.js"></script>
                <script src="../scripts/json_list.js"></script>



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
