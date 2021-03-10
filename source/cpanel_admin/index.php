<?php
session_start();

class webpage_interface_info {

    //information aboutn webpage
    private $_inf_name = 'cpanel index';
    private $_inf_code = 'idxCPL_10202';
    private $_inf_url = 'cpanel/index.php';
    private $_interface_user_access_level = "NORMAL_ADMIN/SUPER_ADMIN";

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
        ?>

        ﻿<!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>DashBoard</title>
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
                                    <h2>ADMIN DASHBOARD</h2>   
                                </div>
                            </div>              
                            <!-- /. ROW  -->
                            <hr />
                            <!--<PAGE CONTENT>===================================-->

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
