<?php
session_start();

class webpage_interface_info {

    //information aboutn webpage
    private $_inf_name = 'product_management';
    private $_inf_code = 'PMCPL_10201';
    private $_inf_url = 'cpanel/product_management.php';
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
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSpecificationDAO.php';

        $connection_db = new db_conn();
        if (isset($_GET['pid']) && !empty(trim($_GET['pid']))) {
            $idproduct_param = $_GET['pid'];
            ?>
            ﻿<!DOCTYPE html>
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <title>Product Management </title>
                    <!-- BOOTSTRAP STYLES-->
                    <link href="assets/css/bootstrap.css" rel="stylesheet" />
                    <!-- FONTAWESOME STYLES-->
                    <link href="assets/css/font-awesome.css" rel="stylesheet" />
                    <!-- CUSTOM STYLES-->
                    <link href="assets/css/custom.css" rel="stylesheet" />
                    <!-- GOOGLE FONTS-->
                    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
                                        <h2>Product Management</h2>   
                                    </div>
                                </div>              
                                <!-- /. ROW  -->
                                <hr />
                                <!--<PAGE CONTENT>===================================-->

                                <div class="row">
                                    <div class="col-md-8">
                                        <?php
                                        $product_ = ProductDAO::getByQuery($connection_db, " idproduct='{$idproduct_param}'", null);
                                        ?>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4>Basic Product Details</h4>
                                            </div>
                                        </div>

                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Property</th>
                                                    <th>Value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if ($product_ != null) {
                                                    ?>

                                                    <tr>
                                                        <td>ID</td>
                                                        <td>
                                                            <button class='btn btn-default'><?php echo $product_->getId(); ?></button>
                                                            <input type="hidden" name="productidname_" id="productid_" value="<?php echo $product_->getId(); ?>">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Code</td>
                                                        <td><input type="text" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo $product_->getCode(); ?>" id="productcode" /></td>
                                                        <td><button class="btn btn-info btn-xs"  name="btn_update_product" id="updateproductcode_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name</td>

                                                        <td><input type="text" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo $product_->getName(); ?>" id="productname" /></td>
                                                        <td><button class="btn btn-info btn-xs"  name="btn_update_product" id="updateproductname_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order</td>
                                                        <td><input type="text" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo $product_->getPorder(); ?>" id="productorder" /></td>
                                                        <td><button class="btn btn-info btn-xs"  name="btn_update_product" id="updateproductorder_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Brand</td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td><button class="btn btn-warning btn-xs"><?php echo strtoupper($product_->getBrand_obj()->getName()); ?></button></td>
                                                                    <td>
                                                                        <select class="form-control" name="pbrand" id="productbrand" style="margin-left: 50px;">
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
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>

                                                        <td><button class="btn btn-info btn-xs"  name="btn_update_product" id="updateproductbrand_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sub Category</td>

                                                        <td><button class="btn btn-warning btn-xs"><?php echo strtoupper($product_->getProduct_sub_category_obj()->getName()); ?></button></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Short Description</td>
                                                        <td><input type="text" id="productshortdescription" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo $product_->getDescription(); ?>"/></td>
                <!--                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="">update</button></td>-->
                                                        <td><button class="btn btn-info btn-xs"  name="btn_update_product" id="updateproductshortdescription_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Offers</td>
                                                        <td>
                                                            <?php
                                                            if ($product_->getOffers_obj() != null) {
                                                                echo "<button class='btn btn-success btn-xs'>" . $product_->getOffers_obj()->getName() . "</button>";
                                                            } else {
                                                                echo "<button class='btn btn-danger btn-xs'>no offers</button>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Retail Price</td>
                                                        <td><input type="text" id="productretailprice" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo number_format($product_->getRetail_price(), 2); ?>"/></td>

                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="updateproductretailprice_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Whole Sale Price</td>
                                                        <td><input type="text" id="productwholesaleprice" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo number_format($product_->getWholesale_price(), 2); ?>"/></td>

                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="updateproductwholesaleprice_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dealer Price</td>
                                                        <td><input type="text" id="productdealerprice" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo number_format($product_->getDealer_price(), 2); ?>"/></td>

                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="updateproductdealerprice_btn">update</button></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Featured Product</td>
                                                        <td>
                                                            <?php
                                                            if ($product_->getIs_featured()) {
                                                                echo "<button class='btn btn-warning btn-xs'>FEATURED</button>";
                                                            } else {
                                                                echo "<button class='btn btn-warning btn-xs'>NO</button>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Image Default </td>
                                                        <td>
                                                            <?php
                                                            if ($product_->getImg_name() != null) {
                                                                echo "<span class='btn btn-default btn-xs'>avilable</span> <span class='btn btn-default btn-xs'>" . $product_->getImg_name() . "</span>";
                                                            } else {
                                                                echo "<span class='btn btn-default btn-xs'>not avilabel</span>";
                                                            }
                                                            ?>
                                                            <br/>
                                                            <form id="product_img_default" method="POST"enctype="multipart/form-data" >
                                                                <input class="btn btn-default" type="file" name="file" required />
                                                                <input type="hidden" name="imageoffset" value="0" />
                                                                <input type="hidden" name="productid" value="<?php echo $product_->getId(); ?>">
                                                            </form>
                                                        </td>
                                                        <td><button class="btn btn-info btn-xs"  onclick="updateProductImages('product_img_default');">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Product Type</td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                        if ($product_->getProduct_type() == 1) {
                                                                            echo "<span class='btn btn-success '>Brand New </span>";
                                                                        } else {
                                                                            echo "<span class='btn btn-warning '>Used</span>";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <!--<br/>-->
                                                                        <!--<br/>-->
                                                                        <select class="form-control" style="width: 200px;margin-left: 50px;" id="producttype">
                                                                            <option value="1">Brand New</option>
                                                                            <option value="2">Used</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>

                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="updateproducttype_btn">update</button></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    echo '<tr><td colspan=3>no data found</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <?php
                                        $product_spec_ = ProductSpecificationDAO::getByQuery($connection_db, " product_idproduct='{$product_->getId()}'", null);
                                        ?>
                                        <div class="row">

                                            <div class="col-md-8">
                                                <h4>Product Specification</h4>
                                            </div>

                                        </div>
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Property</th>
                                                    <th>Value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if ($product_spec_ != null) {
                                                    ?>
                                                    <tr>
                                                        <td>ID</td>
                                                        <td>
                                                            <button class="btn btn-default"><?php echo $product_spec_->getId(); ?></button>
                                                            <input type="hidden" name="productspecidname_" id="productspecid_" value="<?php echo $product_spec_->getId(); ?>">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Image 1 </td>
                                                        <td>
                                                            <?php
                                                            if ($product_spec_->getImgname1() != null) {
                                                                echo "<span class='btn btn-default btn-xs'>avilable</span> <span class='btn btn-default btn-xs'>" . $product_spec_->getImgname1() . "</span>";
                                                            } else {
                                                                echo "<span class='btn btn-default btn-xs'>not avilable</span>";
                                                            }
                                                            ?>
                                                            <br/>
                                                            <form id="product_spec_img_1" method="POST"enctype="multipart/form-data" >
                                                                <input class="btn btn-default" type="file" name="file" required/>
                                                                <input type="hidden" name="imageoffset" value="1" />
                                                                <input type="hidden" name="productid" value="<?php echo $product_->getId(); ?>">
                                                            </form>
                                                        </td>
                                                        <td><button class="btn btn-info btn-xs" onclick="updateProductImages('product_spec_img_1');">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Image 2 </td>
                                                        <td>
                                                            <?php
                                                            if ($product_spec_->getImgname2() != null) {
                                                                echo "<span class='btn btn-default btn-xs'>avilabel</span> <span class='btn btn-default btn-xs'>" . $product_spec_->getImgname2() . "</span>";
                                                            } else {
                                                                echo "<span class='btn btn-default btn-xs'>not avilabel</span>";
                                                            }
                                                            ?>
                                                            <br/>
                                                            <form id="product_spec_img_2" method="POST"enctype="multipart/form-data" >
                                                                <input class="btn btn-default" type="file" name="file" required/>
                                                                <input type="hidden" name="imageoffset" value="2" />
                                                                <input type="hidden" name="productid" value="<?php echo $product_->getId(); ?>">
                                                            </form>
                                                        </td>
                                                        <td><button class="btn btn-info btn-xs" onclick="updateProductImages('product_spec_img_2');">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Product Description</td>
                                                        <td><input type="text" id="productspecdescription" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo $product_spec_->getLong_description(); ?>"/></td>

                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="updateproductspecdescription_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Product Model</td>

                                                        <td><input type="text" id="productspecmodel" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo $product_spec_->getProduct_model(); ?>"/></td>
                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="updateproductspecmodel_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Product Features</td>

                                                        <td><input type="text" id="productspecfeatures" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo $product_spec_->getProduct_features(); ?>"/></td>
                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="updateproductspecfeatures_btn">update</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Release On Date</td>
                                                        <td><input type="text" id="productspecreleaseondate" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 350px;background-color: transparent;" value="<?php echo $product_spec_->getReleased_on() ?>"/></td>
                                                        <td><button class="btn btn-info btn-xs" name="btn_update_product" id="updateproductspecreleaseondate_btn">update</button></td>
                                                    </tr>

                                                    <?php
                                                } else {
                                                    echo '<tr><td colspan=3>no data found</td></tr>';
                                                }
                                                ?>
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
                    <script src="assets/js/jquery-1.10.2.js"></script>
                    <!-- BOOTSTRAP SCRIPTS -->
                    <script src="assets/js/bootstrap.min.js"></script>
                    <!-- CUSTOM SCRIPTS -->
                    <script src="assets/js/custom.js"></script>

                    <script src="../scripts/json_action.js"type="text/javascript"></script>
                    <script src="scripts/product_management.js" type="text/javascript"></script>


                </body>
            </html>
            <?php
        } else {
            echo '<script>
  window.location.href = "product_list.php";
  </script>';
        }
    } else {
        echo '<script>
  window.location.href = "../error_pages/unauthorized.php";
  </script>';
    }
}
?>