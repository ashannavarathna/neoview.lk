<h4>Latest Products </h4>
<ul class="thumbnails">
    <?php
    $result = $connection_db->query("SELECT * FROM product WHERE is_featured='0' and status='1' ORDER BY idproduct DESC LIMIT 6");
    while ($row = mysql_fetch_array($result)) {
        echo "<li class='span3'>";
        echo "<div class='thumbnail'>";
        if ($row['img_name'] == "") {
            echo "<a  href='#' ><img id='showcase_block_grid_view_image' src=' " . __rootaccess_prams::$__upload_dir . "no_image_avl_i.png ' alt=''/></a>";
        } else {
            echo "<a  href='#' ><img id='showcase_block_grid_view_image' src=' " . __rootaccess_prams::$__upload_dir . $row['img_name'] . "' alt=''/></a>";
        }

        echo "<div class='caption'>";
        echo "<h5 id='showcase_block_name'>" . $row['name'] . "</h5>";
        echo "<p style='height:60px;overflow:hidden;'> " . $row['description'] . "</p>";
        echo "<h4 style='text-align:center'><a class='btn' href='product_details.php?pid=" . $row['idproduct'] . "'> <i class='icon-zoom-in'></i></a> <a class='btn hidden' href='#'>Add to <i class='icon-shopping-cart'></i></a> <a class='btn btn-primary' href='#'>" . number_format($row['retail_price'], 2) . "</a></h4>";
        echo "</div>";
        echo " </div>";
        echo "</li>";
    }
    ?>
</ul>
