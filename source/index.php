<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Neo View</title>
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
        <link href="css/custom_style.css" type="text/css" rel="stylesheet">
        <style type="text/css" id="enject"></style>
    </head>
    <body>
        <?php try {
            ?>
            <?php include_once './includes/header.php'; ?>
            <!-- Header End====================================================================== -->
            <?php include_once './includes/indexpage_silder.php' ?>;
            <div id="mainBody">
                <div class="container">
                    <div class="row">
                        <!-- Sidebar ================================================== -->
                        <div id="sidebar" class="span3">
                            <?php include_once './includes/left_menu_full.php'; ?>
                        </div>
                        <!-- Sidebar end=============================================== -->
                        <div class="span9">		
                            <?php include_once './includes/featured_product.php'; ?>
                            <?php include_once './includes/latest_product.php'; ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php
        } catch (Exception $e) {
            echo ' <script>console.log(' . $e . ')</script>';
        }
        ?>
    </div>

    <!-- Footer ================================================================== -->
    <?php // include_once './includes/footer_section.php';   ?>
    <!-- Placed at the end of the document so the pages load faster ============================================= -->
    <script src="themes/js/jquery.js" type="text/javascript"></script>
    <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="themes/js/google-code-prettify/prettify.js"></script>

    <script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>

    <!-- Themes switcher section ============================================================================================= -->

    <!--<span id="themesBtn"></span>-->
</body>
</html>