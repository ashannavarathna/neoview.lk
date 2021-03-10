<div class="well well-small">
    <h4>Featured Products <small class="pull-right">featured products</small></h4>
    <div class="row-fluid">
        <div id="featured" class="carousel slide">
            <div class="carousel-inner">
                <?php
                $result = $connection_db->query("SELECT * FROM product WHERE is_featured='1' and status='1' ORDER BY idproduct DESC LIMIT 12");
                $dataarr1_ = array();
                $dataarr2_ = array();
                $dataarr3_ = array();
                $indexnum = 0;
                while ($row = mysql_fetch_array($result)) {
                    if ($indexnum < 4) {
                        $dataarr1_[] = $row;
                    } else if ($indexnum < 8) {
                        $dataarr2_[] = $row;
                    } else if ($indexnum < 12) {
                        $dataarr3_[] = $row;
                    }
                    $indexnum++;
                }
                ?>

                <?php if (count($dataarr1_) > 0) { ?>
                    <div class='item active'>
                        <ul class='thumbnails'>
                            <?php for ($i_x = 0; $i_x < count($dataarr1_); $i_x++) { ?>

                                <li class="span3">
                                    <div class="thumbnail">
                                        <i class="tag"></i>

                                        <a href="product_details.php?pid=<?php echo $dataarr1_[$i_x][0]; ?>">
                                            <img id='featured_prodcut_block_grid_view_image' src="
                                            <?php
                                            if ($dataarr1_[$i_x]['img_name'] == "") {
                                                echo __rootaccess_prams::$__upload_dir . 'no_image_avl_i.png';
                                            } else {
                                                echo __rootaccess_prams::$__upload_dir . $dataarr1_[$i_x]['img_name'];
                                            }
                                            ?>" alt=""></a>
                                        <div class="caption">
                                            <h5><?php echo $dataarr1_[$i_x]['name']; ?></h5>
                                            <h4><a class="btn"  href="product_details.php?pid=<?php echo $dataarr1_[$i_x][0]; ?>">VIEW</a> <span class="pull-right"><?php echo number_format($dataarr1_[$i_x]['retail_price'], 2); ?></span></h4>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } if (count($dataarr2_) > 0) { ?>
                    <div class="item">
                        <ul class="thumbnails">
                            <?php for ($i_x = 0; $i_x < count($dataarr2_); $i_x++) { ?>
                                <li class="span3">
                                    <div class="thumbnail">
                                        <i class="tag"></i>
                                        <a href="product_details.php?pid=<?php echo $dataarr2_[$i_x][0]; ?>">
                                            <img id='featured_prodcut_block_grid_view_image' src="
                                            <?php
                                            if ($dataarr2_[$i_x]['img_name'] == "") {
                                                echo __rootaccess_prams::$__upload_dir . 'no_image_avl_i.png';
                                            } else {
                                                echo __rootaccess_prams::$__upload_dir . $dataarr2_[$i_x]['img_name'];
                                            }
                                            ?>" alt=""></a>
                                        <div class="caption">
                                            <h5><?php echo $dataarr2_[$i_x]['name']; ?></h5>
                                            <h4><a class="btn"  href="product_details.php?pid=<?php echo $dataarr2_[$i_x][0]; ?>">VIEW</a> <span class="pull-right"><?php echo number_format($dataarr2_[$i_x]['retail_price'], 2); ?></span></h4>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } if (count($dataarr3_) > 0) { ?>
                    <div class="item">
                        <ul class="thumbnails">
                            <?php for ($i_x = 0; $i_x < count($dataarr3_); $i_x++) { ?>
                                <li class="span3">
                                    <div class="thumbnail">
                                        <i class="tag"></i>

                                        <a href="product_details.php?pid=<?php echo $dataarr3_[$i_x][0]; ?>">
                                            <img id='featured_prodcut_block_grid_view_image' src="
                                            <?php
                                            if ($dataarr3_[$i_x]['img_name'] == "") {
                                                echo __rootaccess_prams::$__upload_dir . 'no_image_avl_i.png';
                                            } else {
                                                echo __rootaccess_prams::$__upload_dir . $dataarr3_[$i_x]['img_name'];
                                            }
                                            ?>" alt=""></a>
                                        <div class="caption">
                                            <h5><?php echo $dataarr3_[$i_x]['name']; ?></h5>
                                            <h4><a class="btn"  href="product_details.php?pid=<?php echo $dataarr3_[$i_x][0]; ?>">VIEW</a> <span class="pull-right"><?php echo number_format($dataarr3_[$i_x]['retail_price'], 2); ?></span></h4>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <!-- index count end @ 12 ==================================>
                <!--                <div class="item">
                                    <ul class="thumbnails">
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <a href="product_details.html"><img src="themes/images/products/2.jpg" alt=""></a>
                                                <div class="caption">
                                                    <h5>Product name</h5>
                                                    <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <a href="product_details.html"><img src="themes/images/products/3.jpg" alt=""></a>
                                                <div class="caption">
                                                    <h5>Product name</h5>
                                                    <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <a href="product_details.html"><img src="themes/images/products/4.jpg" alt=""></a>
                                                <div class="caption">
                                                    <h5>Product name</h5>
                                                    <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <a href="product_details.html"><img src="themes/images/products/5.jpg" alt=""></a>
                                                <div class="caption">
                                                    <h5>Product name</h5>
                                                    <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>-->
            </div>
            <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#featured" data-slide="next">›</a>
        </div>
    </div>
</div>
