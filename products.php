<?php
$page_title = 'Products - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';

$sql = "SELECT * FROM products ORDER BY product_id DESC";
$result = $db->query($sql);

?>


<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us News. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem
            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
            galley of type and scrambled it to make a type specimen book.</p>
    </div>
    <section>
        <?php
        $counter = 0;
        $num_rows = $result->num_rows;
        while ($counter < $num_rows){
            echo "<div class=\"products_display\">";
                if ($counter < $num_rows){
                    list($product_id, $product_name, $product_description, $product_price, $product_thumbnail, $product_lrg_img, $product_date) = $result->fetch_row();
                    echo "<div class=\"products_display_col1\">
                        <img class=\"thumb\" src=\"$product_thumbnail\" alt=\"product thumbnail\" /> <span class=\"product_name\"><a href=\"products_show.php?product_id=$product_id\"> $product_name</a></span> <br /> <span class=\"price\">$$product_price</span>
                    </div>";
                    $counter += 1;
                }
                if ($counter < $num_rows){
                    list($product_id, $product_name, $product_description, $product_price, $product_thumbnail, $product_lrg_img, $product_date) = $result->fetch_row();
                    echo "<div class=\"products_display_col2\">
                        <img class=\"thumb\" src=\"$product_thumbnail\" alt=\"product thumbnail\" /> <span class=\"product_name\"><a href=\"products_show.php?product_id=$product_id\"> $product_name</a></span> <br /> <span class=\"price\">$$product_price</span>
                    </div>";
                    $counter += 1;
                }
                if ($counter < $num_rows){
                    list($product_id, $product_name, $product_description, $product_price, $product_thumbnail, $product_lrg_img, $product_date) = $result->fetch_row();
                    echo "<div class=\"products_display_col3\">
                        <img class=\"thumb\" src=\"$product_thumbnail\" alt=\"product thumbnail\"  /> <span class=\"product_name\"><a href=\"products_show.php?product_id=$product_id\"> $product_name</a></span> <br /> <span class=\"price\">$$product_price</span>
                    </div>";
                    $counter += 1;
                }

            echo "</div>";
        }
        echo '<div id="space"></div>';
        mysqli_close($db);
        ?>

    </section>

</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>

