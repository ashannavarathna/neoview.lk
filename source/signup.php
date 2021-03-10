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
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserGenderDAO.php';

$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>sign up </title>
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
                            <li class="active">Registration</li>
                        </ul>
                        <h3> Registration</h3>	
                        <div class="well">
                            <!--
                            <div class="alert alert-info fade in">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                             </div>
                            <div class="alert fade in">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                             </div>
                             <div class="alert alert-block alert-error fade in">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                             </div> -->
                            <form class="form-horizontal" id="signupForm" method="POST">
                                <h4>Your personal information</h4>
                                <div class="control-group">
                                    <label class="control-label" for="firstname">First name <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text" id="firstname" name='firstname' placeholder="First Name" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="lastname">Last name <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text" id="lastname" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="control-group" >
                                    <label class="control-label" for="dob">Date of Birth <sup>*</sup></label>
                                    <div class="controls">
                                        <select class="span1" name="dob_days"  id="dob_days">
                                            <option value="">-date-</option>
                                            <?php
                                            for ($index = 1; $index <= 31; $index++) {
                                                $day = $index;
                                                if ($index < 10) {
                                                    $day = '0' . $index;
                                                }
                                                echo "<option value='{$day}'>{$day}</option>";
                                            }
                                            ?>
                                        </select>
                                        <select class="span1" name="dob_month" id="dob_month">
                                            <option value="">-month-</option>
                                            <?php
                                            for ($index = 1; $index <= 12; $index++) {
                                                $month = $index;
                                                if ($index < 10) {
                                                    $month = '0' . $index;
                                                }
                                                echo "<option value='{$month}'>{$month}</option>";
                                            }
                                            ?>
                                        </select>
                                        <select class="span1" name="dob_year" id="dob_year">
                                            <option value="">-year-</option>
                                            <?php
                                            for ($index = date("Y") - 120; $index <= date("Y"); $index++) {
                                                $year = $index;
                                                echo "<option value='{$index}'>{$year}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="gender">Gender <sup>*</sup></label>
                                    <div class="controls">
                                        <select class="span1" name="gender" id="gender" style="width: 145px;">
                                            <option value="">-gender-</option>
                                            <?php
                                            $gender = UserGenderDAO::listByQuery($connection_db, null, null);
                                            foreach ($gender as $gen) {
                                                echo "<option value='{$gen->getId()}'>{$gen->getType()}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="email">Email <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>	  
                                <div class="control-group">
                                    <label class="control-label" for="password">Password <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="password" id="password" name="password" placeholder="Password">
                                    </div>
                                </div>	  
                                <div class="control-group">
                                    <label class="control-label" for="password_cmf">Confirm Password <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="password" id="password_cmf" name="password_cmf" placeholder="Confirm Password">
                                    </div>
                                </div>



                                <h4>Your address</h4>
                                <div class="control-group">
                                    <label class="control-label" for="address_no">No <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text" id="address_no" name="address_no" placeholder="N0">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="address_line1">Line 1 <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text" id="address_line1" name="address_line1" placeholder="Line 1"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="address_line2">Line 2 <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text" id="address_line2" name="address_line2" placeholder="Line 2"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="address_line3">Line 3 <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text" id="address_line3" name="address_line3" placeholder="Line 3"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="address_line4">Line 4 <sup> </sup></label>
                                    <div class="controls">
                                        <input type="text" id="address_line4" name="address_line4" placeholder="Line 4"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="postcode">Zip / Postal Code<sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text" id="postcode" name="postcode" placeholder="Zip / Postal Code"/> 
                                    </div>
                                </div>

                                <h4>Your Contacts</h4>
                                <div class="control-group">
                                    <label class="control-label" for="mobile_phone">Mobile Phone <sup>*</sup></label>
                                    <div class="controls">
                                        <input type="text"  name="mobile_phone" id="mobile_phone" placeholder="Mobile"/> <span></span>
                                    </div>
                                </div>

                                <!--<p><sup>*</sup>Required field	</p>-->
                                <input type="hidden" value="sumbitted_done" name="dataquery">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="hidden" name="email_create" value="1">
                                        <input type="hidden" name="is_new_customer" value="1">
                                        <input class="btn btn-large btn-success" type="submit" value="Register" />
                                    </div>
                                </div>

                                <div class="alert alert-block  fade in hidden" id="submit_alert_box">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <span id="from_data_submit_msg"><strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</span>
                                </div>
                            </form>
                        </div>

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
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>


        <script src="themes/js/bootshop.js"></script>
        <script src="themes/js/jquery.lightbox-0.5.js"></script>

        <!-- Page Scriptis===================================== -->
        <script src="scripts/signup.js" type="text/javascript"></script>


    </body>
</html>