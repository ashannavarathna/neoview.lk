
<ul id="sideManu" class="nav nav-tabs nav-stacked">
    <?php
    $pcatlist = ProductCategoryDAO::listByQuery($connection_db, null, null);
    $flag = true;
    foreach ($pcatlist as $catob) {
        if ($flag) {

            echo "<li class='subMenu open'><a> " . strtoupper($catob->getName()) . " </a>";
        } else {
            echo "<li class='subMenu'><a> " . strtoupper($catob->getName()) . " </a>";
        }
        $psubcatlist = ProductSubCategoryDAO::listByQuery($connection_db, " product_category_idproduct_category='{$catob->getId()}'", null);
        if ($flag) {
            echo "<ul>";
        } else {
            echo "<ul style='display:none'>";
        }
        $flagactive = true;
        foreach ($psubcatlist as $subcatob) {
            if ($flagactive) {
                echo "<li><a class='active' href='products.php?subcc__prd_id=".$subcatob->getId()."'><i class='icon-chevron-right'></i>" . strtoupper($subcatob->getName()) . "</a></li>";
            } else {
                echo "<li><a class='' href='products.php?subcc__prd_id=".$subcatob->getId()."'><i class='icon-chevron-right'></i>" . strtoupper($subcatob->getName()) . "</a></li>";
            }
            $flagactive = false;
        }
        echo '</ul>';
        echo '</li>';
        $flag = false;
    }
    ?>
</ul>

