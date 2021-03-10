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
        <title>About Us </title>
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
                    <div class="span9" id="mainCol">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                            <li class="active">About Us</li>
                        </ul>
                        <h3> Neoview</h3>	
                        <hr class="soft"/>
                        
                        <h5>Neoview Private Limited</h5><br/>
                        <br/>
                        <div>
                            <div><img src="images/site/about_us_slider/_1.jpg" style="width: 100%;height: 400px;"></div>
                            <br/>
                            <div>
                                <img src="images/site/about_us_slider/_2.jpg" style="width: 20%;height: 100px;margin-left: 3px;">
                                <img src="images/site/about_us_slider/_3.jpg" style="width: 20%;height: 100px;margin-left: -5px;">
                                <img src="images/site/about_us_slider/_4.jpg" style="width: 20%;height: 100px;margin-left: -5px;">
                                <img src="images/site/about_us_slider/_5.jpg" style="width: 20%;height: 100px;margin-left: -5px;">
                                <img src="images/site/about_us_slider/_6.jpg" style="width: 20%;height: 100px;margin-left: -5px;">
                            </div>
                        </div>
                        <br/>
                        <p>
                            Neoview Private Limited was founded in 2007. We are the largest whole seller and the retailer in the industry. We directly import computers from South Korea and China. All of our sales have a Neoview warranty. We have well trained staff to serve you with a smile and tend to your every need when essential we can give you the best solutions
                            We offer one of the widest and best selections available for desktop computers, laptops, accessories and much more..Our goal is to continually provide the best service and the best products. We are now working to offer our services and great deals to even more people.
                            We deal with the latest most and up-to-date computing products ranging from Laptops, desktops, parts and accessories. Additionally we deal with the latest Electronic Device and Mobile Devices ranging LED TV, Speakers, Printers, SUB Woofer, Phone Charger, Phone Cable etc. We Specializing in the Computer maintain and Repair.  We provide our customers computer needs to efficiency and an excellent after sales service.
                            As a technology provider, we seek to deliver quality products at affordable and competitive prices, because we understand your needs and we strive to serve you better.
                            Our main location is No 95, Kandy Road, Yakkala. We are also located in No.16, Central bus stand, Gampaha and No.582/A, Colombo Road, Nambadaluwa, Nittabuwa.
                            To all of you, from all of us at Neoview Private Limited - Thank you and Happy shopping with Us!

                        </p>
                        <br/>
                        <h5>Company Details</h5>
                        <h6>Company Name : <span style="font-weight: normal;">Neoview Private Limited </span> </h6>
                        <h6>Location     : <span style="font-weight: normal;">No.95, Kandy Road,Yakkala.  </span> </h6>
                        <h6>Date of Establishment  : <span style="font-weight: normal;">31 OCT 2007.  </span> </h6>
                        <br/>
                        <h5> Directors  :</h5>
                        <table>
                            <tr>
                                <th style="width: 200px;">Mr.G.U.Wasantha</th>
                                <th>Mr.G.T.Duminda</th>
                                
                            </tr>
                            <tr>
                                <td>+94 71 5 773 328</td>
                                <td>+94 71 6 843 038</td>
                            </tr>
                            <tr>
                                <td>+94 33 2 232 232</td>
                                <td>+94 33 2 232 232</td>
                            </tr>
                        </table>
                    </div>
                </div></div>
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
        <!--<script src="js/jquery.validate.min.js" type="text/javascript"></script>-->
        <!--<script src="js/additional-methods.min.js" type="text/javascript"></script>-->


<script src="themes/js/bootshop.js"></script>
<script src="themes/js/jquery.lightbox-0.5.js"></script>

<!-- Page Scriptis===================================== -->



</body>
</html>