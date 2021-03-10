<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="adjust-nav">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="../images/site/logo_neo_veiw.png" height="50" width="100" />

            </a>

        </div>

        <?php
        if (isset($_SESSION['user'])) {
            ?>
            <span class="logout-spn" >
                <a href="src/cpanel_logout.php" style="color:#fff;">LOGOUT</a>  
            </span>
            <?php
        } else {
            ?>
            <span class="logout-spn" >
                <a href="login.php" style="color:#fff;">LOGIN</a>  

            </span>
            <?php
        }
        ?>
    </div>
</div>