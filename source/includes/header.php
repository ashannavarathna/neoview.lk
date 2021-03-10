<?php
$document_root = realpath($_SERVER["DOCUMENT_ROOT"]);

//main inclued files
//online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';
//sub inclued files
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/connection/db_conn.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductCategoryDAO.php';
require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ProductSubCategoryDAO.php';

//databace object
try {
    $connection_db = new db_conn();
    ?>
    <div id="header">
        <div class="container">
            <div id="welcomeLine" class="row">
                <?php
                if (isset($_SESSION['user'])) {
                    $user_arr = $_SESSION['user'];
//                echo print_r($user_arr);
                    echo "<div class='span6'>Hello! <strong> <a href='user_profile.php?uid=" . $user_arr['_iduser_profile'] . "'>" . $user_arr['_user_name'] . " </strong></div>";
                } else {
                    echo "<div class='span6'>Welcome! <strong>  </strong></div>";
                }
                ?>
                <div class="span6">
                    <!--                <div class="pull-right">
                                        <a href="product_summary.html"><span class="">Fr</span></a>
                                        <a href="product_summary.html"><span class="">Es</span></a>
                                        <span class="btn btn-mini">En</span>
                                        <a href="product_summary.html"><span>&dollar;</span></a>
                                        <span class="btn btn-mini">$00.00</span>
                                        <a href="product_summary.html"><span class="">$</span></a>
                                        <a href="product_summary.html"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 0 ] Itemes in your cart </span> </a> 
                                    </div>-->
                </div>
            </div>
            <!-- Navbar ================================================== -->
            <div id="logoArea" class="navbar">
                <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-inner">
                    <a class="brand" href="index.php"><img src="./images/site/logo_neo_veiw.png" width="100" height="50" alt="Bootsshop"/></a>
                    <form class="form-inline navbar-search" method="POST" action="products.php" >
                        <input id="srchFld" class="srchTxt" type="text" name="srch__name_prd" />
                        <select class="srchTxt" name="subcc__prd_id">
                            <optgroup label="All Products">
                                <option value="">All</option>
                            </optgroup>
                            <?php
                            $productmcatlist = ProductCategoryDAO::listByQuery($connection_db, null, null);
                            foreach ($productmcatlist as $mcatob) {
                                echo "<optgroup label='{$mcatob->getName()}'>";
                                $productsubcatlist = ProductSubCategoryDAO::listByQuery($connection_db, " product_category_idproduct_category='{$mcatob->getId()}'", null);
                                foreach ($productsubcatlist as $subcatob) {
                                    echo " <option value='{$subcatob->getId()}'>{$subcatob->getName()}</option>";
                                }
                                echo "</optgroup>";
                            }
                            ?>
                        </select>
                        <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
                    </form>
                    <ul id="topMenu" class="nav pull-right">
                        <li class=""><a href="./abount_us.php">About Us</a></li>
                        <li class=""><a href="./price_list.php">Price List</a></li>
                        <li class=""><a href="./contacts.php ">Contact</a></li>
                        <li class=""><a href="signup.php" id='signuplink' style="color:#ffd041;font-weight:bolder;font-size: 18px;">Sign up</a></li>

                        <li class="">
                            <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
                            <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3>Login Block</h3>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal loginFrm">
                                        <div class="control-group">								
                                            <input type="text" id="inputEmail" placeholder="Email">
                                        </div>
                                        <div class="control-group">
                                            <input type="password" id="inputPassword" placeholder="Password">
                                        </div>
                                        <div class="control-group">
                                            <label class="checkbox">
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </form>		
                                    <button type="submit" class="btn btn-success">Sign in</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
} catch (Exception $e) {

    echo '<script>console.log(' . $e . ')</script>';
}
?>

