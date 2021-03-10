<?php
session_start();

if (isset($_SESSION['user'])) {
    echo '<script>
  window.location.href = "index.php";
  </script>';
}
?>

﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cpanel Login</title>
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
            <!--?php include_once './inclueds/left_nav.php'; ?-->
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Cpanel Login</h2>   
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />
                    <!--<PAGE CONTENT>===================================-->
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <h5>Login</h5>
                            <form id="cpanel_login" method="post" action="src/cpanel_login.php">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" name="email" class="form-control" placeholder="Username" />
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon">P&nbsp;</span>
                                    <input type="password" name="password" class="form-control" placeholder="password" />
                                </div>
                                <br />
                                <div class="input-group">
                                    <div class="row">
                                        <input type="hidden" name="dataset_" value="data">
                                            <div class="col-md-12"><input type="submit" value="Log In" class="btn btn-primary " style="width: 317px;"></div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_GET['msg'])) {
                                ?>
                                <div class="alert alert-block alert-info  fade in show" id="submit_alert_box">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <span id="from_data_submit_msg"><strong>SERVER : <?php echo $_GET['msg'] ?> </strong> </span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>



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


    </body>
</html>
