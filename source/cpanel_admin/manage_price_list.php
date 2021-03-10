<?php
session_start();

class webpage_interface_info {

    //information aboutn webpage
    private $_inf_name = 'Manage Price List';
    private $_inf_code = 'CPL_MNGPRSLST';
    private $_inf_url = 'cpanel/manage_price_list.php';
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
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/PriceListCategoryDAO.php';
        require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/PriceListImagesDAO.php';

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
                                    <h2>Manage Price List</h2>   
                                </div>
                            </div>              
                            <!-- /. ROW  -->
                            <hr />
                            <!--<PAGE CONTENT>===================================-->
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Price List Category</h4>
                                </div>
                            </div>
                            <br/>
                            <div class="row">

                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Ctrl.</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $price_list_category = PriceListCategoryDAO::listByQuery($connection_db, null, null);

                                            foreach ($price_list_category as $ob) {
                                                ?>
                                                <tr>
                                                    <form id="price_list_category_id_<?php echo $ob->getId(); ?>" method="POST"enctype="multipart/form-data" >

                                                        <td>
                                                            <?php echo $ob->getId(); ?>
                                                            <input type="hidden" name="ctid" value="<?php echo $ob->getId(); ?>"/>
                                                            <input type="hidden" name="SubmitType" value="PRSLSTCATEGROY"/>

                                                        </td>
                                                        <td>
                                                            <input type="text"   name="catname" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 100%;background-color: transparent;font-size: 12px;" value="<?php echo strtoupper($ob->getName()); ?>"/>
                                                        </td>
                                                        <td><?php
                                                            if (!empty($ob->getImage_name())) {
                                                                echo "<span class='btn btn-default btn-xs'>avilable</span> <span class='btn btn-xs btn-default'>" . $ob->getImage_name() . "</span>";
                                                            }
                                                            ?>
                                                            <br/>
                                                            <input type="file" name="file" class="btn btn-default btn-xs" style="margin-top: 5px;" /></td>
                                                        <td><a onclick="managePriceListFormControls('price_list_category_id_<?php echo $ob->getId(); ?>', 'UPDATE')" class="btn btn-primary btn-xs">update</a></td>
                                                        <td><a onclick="managePriceListFormControls('price_list_category_id_<?php echo $ob->getId(); ?>', 'REMOVE')" class="btn btn-danger btn-xs">remove</a></td>
                                                    </form>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <form id="price_list_category_new" method="POST"enctype="multipart/form-data" >
                                                    <td>#
                                                        <input type="hidden" name="ctid" value=""/>
                                                        <input type="hidden" name="SubmitType" value="PRSLSTCATEGROY"/>
                                                    </td>
                                                    <td>
                                                        <input type="text"  name="catname" style="padding: 5px;border: none;border-bottom: 1px solid #CCC; width: 100%;background-color: transparent; font-size: 12px;" value=""/>
                                                    </td>
                                                    <td> <input class="btn btn-default btn-xs" style="margin-top: 5px;" type="file" name="file"></td>
                                                    <td><a onclick="managePriceListFormControls('price_list_category_new', 'NEW')" class="btn btn-success btn-xs" >Save</a></td>
                                                    <td></td>
                                                </form>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br/>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Price Lists</h4>
                                </div>
                            </div>
                            <br/>
                            <div class="row">

                                <div class="col-md-8">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Price Image</th>
                                                <th>Category</th>
                                                <th>Ctrl</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $pricelist = PriceListImagesDAO::listByQuery($connection_db, null, null);

                                            foreach ($pricelist as $plst) {
                                                ?>

                                                <tr>
                                                    <form id="price_list_update_<?php echo $plst->getId(); ?>" method="POST"enctype="multipart/form-data">
                                                        <td>
                                                            <?php echo $plst->getId(); ?>
                                                            <input type="hidden" name="id" value="<?php echo $plst->getId(); ?>"/>
                                                            <input type="hidden" name="SubmitType" value="PRSLST"/>
                                                            <!---->
                                                        </td>
                                                        <td><?php
                                                            if (!empty($plst->getImage_name())) {
                                                                echo "<span class='btn btn-xs btn-default'>" . $plst->getImage_name() . "</span>";
                                                            }
                                                            ?>
                                                            <br/>
                                                            <input type="file" name="file" class="btn btn-default btn-xs" style="margin-top: 5px;" />
                                                        </td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td><span class="btn btn-xs btn-default"><?php echo $plst->getPrice_list_category_obj()->getName(); ?></span></td>
                                                                    <td>
                                                                        <select name="idpricelstcat" style="margin-left: 20px;">
                                                                            <option value="">-Select-</option>
                                                                            <?php
                                                                            foreach ($price_list_category as $ob2) {
                                                                                echo "<option value='{$ob2->getId()}'>{$ob2->getName()}</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td><a onclick="managePriceListFormControls('price_list_update_<?php echo $plst->getId(); ?>', 'UPDATE')" class="btn btn-primary btn-xs">update</a></td>
                                                        <td><a onclick="managePriceListFormControls('price_list_update_<?php echo $plst->getId(); ?>', 'REMOVE')" class="btn btn-danger btn-xs">remove</a></td>
                                                    </form>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <form id="price_list_update_new" method="POST"enctype="multipart/form-data">
                                                    <td>

                                                        <input type="hidden" name="id" value=""/>
                                                        <input type="hidden" name="SubmitType" value="PRSLST"/>
                                                        <!---->
                                                    </td>
                                                    <td>
                                                        <input type="file" name="file" class="btn btn-default btn-xs" style="margin-top: 5px;" />
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                
                                                                <td colspan="2">
                                                                    <select name="idpricelstcat" >
                                                                        <option value="">-Select-</option>
                                                                        <?php
                                                                        foreach ($price_list_category as $ob2) {
                                                                            echo "<option value='{$ob2->getId()}'>{$ob2->getName()}</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td><a onclick="managePriceListFormControls('price_list_update_new', 'NEW')" class="btn btn-success btn-xs">Save</a></td>
                                                </form>
                                            </tr>
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
                <script src="scripts/price_list_managment.js" type="text/javascript"></script>
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