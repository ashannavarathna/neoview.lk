<?php
session_start();

class webpage_interface_info {

    //information aboutn webpage
    private $_inf_name = 'Manage Product Category';
    private $_inf_code = 'CPL_MNGPRDCAT';
    private $_inf_url = 'cpanel/manage_product_category.php';
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
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductCategoryDAO.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSubCategoryDAO.php';

        $connection_db = new db_conn();
        ?>
        ﻿<!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Manage Product Category</title>
                <!-- BOOTSTRAP STYLES-->
                <link href="assets/css/bootstrap.css" rel="stylesheet" />
                <!-- FONTAWESOME STYLES-->
                <link href="assets/css/font-awesome.css" rel="stylesheet" />
                <!-- CUSTOM STYLES-->
                <link href="assets/css/custom.css" rel="stylesheet" />
                <!-- GOOGLE FONTS-->
                <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
                <!-- form validation ============== -->
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
                                    <h2>Product Category Management</h2>   
                                </div>
                            </div>              
                            <!-- /. ROW  -->
                            <hr />
                            <!--<PAGE CONTENT>===================================-->
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Main Category</h4>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-4">
                                    <form id="form_product_category" method="post">
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="productcategory_code" id="productcategory_code" class="form-control" placeholder="Code" />
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="productcategory_name" id="productcategory_name" class="form-control" placeholder="Name" />
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <input type="hidden" name="dataset_" value="data">
                                                <input type="button" onclick="saveProductCategory()"  value="Create"  class="btn btn-success pull-right" style="width: 114px;margin-left: 200px;"/>
                                        </div>
                                    </form>
                                    <br>
                                        <div class="alert alert-block  fade in hidden" id="submit_alert_box_pcat">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <span id="from_data_submit_msg_pcat"> </span>
                                        </div>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Ctrl.</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $product_categpry_list = ProductCategoryDAO::listByQuery($connection_db, null, null);

                                            foreach ($product_categpry_list as $ob) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $ob->getId(); ?></td>
                                                    <td>
                                                        <input type="text" id="productmaincatcode_<?php echo $ob->getId(); ?>" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 100%;background-color: transparent;" value="<?php echo strtoupper($ob->getCode()); ?>"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="productmaincatname_<?php echo $ob->getId(); ?>" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 100%;background-color: transparent;" value="<?php echo strtoupper($ob->getName()); ?>"/>
                                                    </td>
                                                    <td><a onclick="updateProductCategory('<?php echo $ob->getId() ?>')" class="btn btn-primary btn-xs">update</a></td>
                                                    <td><a onclick="removeMainCategory('<?php echo $ob->getId() ?>')" class="btn btn-danger btn-xs">remove</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br/>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Sub Category</h4>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-4">
                                    <form id="cpanel_login" method="post">
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <select class="form-control" id="maincategorycombo">
                                                <option value="">-Select-</option>
                                                <?php
                                                $maincategory_list = ProductCategoryDAO::listByQuery($connection_db, null, null);
                                                foreach ($product_categpry_list as $ob) {
                                                    ?>
                                                <option value="<?php echo $ob->getId() ?>"><?php echo strtoupper($ob->getName()) ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="code" id="productsubcategory_code" class="form-control" placeholder="Code" />
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="name" id="productsubcategory_name" class="form-control" placeholder="Name" />
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <input type="hidden" name="dataset_" value="data">
                                                <input type="button" onclick="saveProductSubCategory();" value="Create"  class="btn btn-success pull-right" style="width: 114px;margin-left: 200px;"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>M Category</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Ctrl.</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $product_sub_category_list = ProductSubCategoryDAO::listByQuery($connection_db, null, null);

                                            foreach ($product_sub_category_list as $obsub) {
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td><span class="btn btn-default btn-xs"><?php echo strtoupper($obsub->getProduct_category_obj()->getName()); ?></span></td>
                                                    <td>
                                                        <input type="text" id="productsubcatcode_<?php echo $obsub->getId(); ?>" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 100%;background-color: transparent;" value="<?php echo strtoupper($obsub->getCode()); ?>"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="productsubcatname_<?php echo $obsub->getId(); ?>" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 100%;background-color: transparent;" value="<?php echo strtoupper($obsub->getName()); ?>"/>
                                                    </td>
                                                    <td><a onclick="updateProductSubCategory('<?php echo $obsub->getId() ?>')" class="btn btn-primary btn-xs">update</a></td>
                                                    <td><a onclick="removeSubCategory('<?php echo $obsub->getId() ?>')" class="btn btn-danger btn-xs">remove</a></td>
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
                <script src="assets/js/jquery-1.10.2.js"></script>
                <!-- BOOTSTRAP SCRIPTS -->
                <script src="assets/js/bootstrap.min.js"></script>
                <!-- CUSTOM SCRIPTS -->
                <script src="assets/js/custom.js"></script>


                <script src="../scripts/json_action.js" type="text/javascript"></script>
                <script src="scripts/product_option_handler.js" type="text/javascript"></script>
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