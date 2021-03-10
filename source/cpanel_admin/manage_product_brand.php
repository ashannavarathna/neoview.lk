<?php
session_start();

class webpage_interface_info {

    //information aboutn webpage
    private $_inf_name = 'Manage_Product_Brand';
    private $_inf_code = 'CPL_MNHPRDBRND';
    private $_inf_url = 'cpanel/manage_product_brand.php';
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
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/BrandDAO.php';


        $connection_db = new db_conn();
        ?>
        ﻿<!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Manage Brand</title>
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
                                    <h2>Manage Product Brand</h2>   
                                </div>
                            </div>              
                            <!-- /. ROW  -->
                            <hr />
                            <!--<PAGE CONTENT>===================================-->
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Brand</h4>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-4">
                                    <form id="cpanel_login" method="post">
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="code" id="brand_code" class="form-control" placeholder="Code" />
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">:)</span>
                                            <input type="text" name="name" id="brand_name" class="form-control" placeholder="Name" />
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <input type="hidden" name="dataset_" value="data">
                                                <input type="button" onclick="saveBrand()" value="Create"  class="btn btn-success pull-right" style="width: 114px;margin-left: 200px;"/>
                                        </div>
                                    </form>
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
                                            $brand_list = BrandDAO::listByQuery($connection_db, null, null);

                                            foreach ($brand_list as $ob) {
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <input type="text" id="productbrandcode_<?php echo $ob->getId() ?>" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 100%;background-color: transparent;" value="<?php echo strtoupper($ob->getCode()); ?>"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="productbrandname_<?php echo $ob->getId() ?>" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 100%;background-color: transparent;" value="<?php echo strtoupper($ob->getName()); ?>"/>
                                                    </td>
                                                    <td><a onclick="updateProductBrand('<?php echo $ob->getId(); ?>')" class="btn btn-primary btn-xs">update</a></td>
                                                    <td><a onclick="removeProductBrand('<?php echo $ob->getId(); ?>')" class="btn btn-danger btn-xs">remove</a></td>
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