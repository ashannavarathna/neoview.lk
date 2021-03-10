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

$connection_db;
if (!isset($connection_db)) {
    $connection_db = new db_conn();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Templates </title>
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
                    <div class="span2"></div>
                    <div class="span4"><h1>Visit us</h1></div>
                    <div class="span3"><h1>We are Open</h1></div>
                    <div class="span1"></div>

                </div>
                <hr class="soften">
                <div class="row">
                    <div class="span2"></div>
                    <div class="span4">
                        <h4>Contact Details</h4>
                        <p>	45 Kandy Road,<br/> Yakkala, Srilanka
                            <br/><br/>
                            <!--info@bootsshop.com<br/>-->
                            ﻿Tel +9433 2  232 232 <br/>
                            web:neoview.lk
                        </p>		
                    </div>
                    <div class="span3">
                        <h4>Opening Hours</h4>
                        <h5> Monday - Friday</h5>
                        <p>09:00am - 09:00pm<br/><br/></p>
                        <h5>Saturday</h5>
                        <p>09:00am - 07:00pm<br/><br/></p>
                        <h5>Sunday</h5>
                        <p>12:30pm - 06:00pm<br/><br/></p>
                    </div>
                    <div class="span1"></div>
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