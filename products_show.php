<?php
$page_title = 'Products - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/utilities.php';

$product_id = $_GET['product_id'];

$sql = "SELECT * FROM products WHERE product_id=$product_id";
$result = $db->query($sql);
list($product_id, $product_name, $description, $price, $thumbnail, $lrg_img, $product_date) = $result->fetch_row();

$pub_date_timestamp = date_create($product_date);
$pub_date_timestamp = date_format($pub_date_timestamp, 'M-d-Y');

# get average ratings for comment
$sql_rate = "SELECT AVG(rate) FROM reviews WHERE product_id=$product_id";
$result_rate = $db->query($sql_rate);
list($avg_rating) = $result_rate->fetch_row();
$avg_rating_stars = rating_stars($avg_rating);

?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
            took a galley of type and scrambled it to make a type specimen book.</p>
    </div>
    <section id="products">
        <?php
$show = <<<EOF

        <div id="products_show">
            <img src="$lrg_img" id="large_img" alt="product image">
            <ul>
                <li>$avg_rating_stars</li>
                <li id="products_show_name">$product_name</li>
                <li id="products_show_price">$$price</li>
                <li id="products_show_description">$description</li>
                <li id="products_show_date">$pub_date_timestamp</li>
            </ul>
        </div>

EOF;

        echo $show;

        # Query Comments Start
        $sql = "SELECT * FROM reviews WHERE product_id=$product_id";
        $result = $db->query($sql);

        echo "<div class=\"product_review\">";
        echo "<h2>Reviews</h2>";
        while (list($review_id, $r_author, $review, $rate, $r_date, $rev_product_id) = $result->fetch_row()) {
            $rating_stars = rating_stars($rate);
            $time_stamp = strtotime($r_date);
            $ago = time_elapsed_string($time_stamp);
$review_show = <<<EndOfComment
            <ul>
            <li>$rating_stars</li>
            <li>$r_author</li>
            <li>$review</li>
            <li>$ago</li>
            </ul>
            <hr>
EndOfComment;
            echo $review_show;
        };
        echo "</div>";
        # Query Comments End

        # New Comments Form
$new_review = <<<EOF
        <div class="product_review">
        <h2>Your Reviews are Welcome</h2>
        <form method="post" action="review_new.php">
            <input type="hidden" name="product_id" value="$product_id" />
            <input type="text" name="r_author" placeholder="Author" value="$r_author" /> <br />
            <textarea name="review" rows="5" cols="30" maxlength="500" placeholder="Enter Comment">$review</textarea> <br />
            <select name="rate">
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select> <br />
            <input type="submit" name="submit" value="Submit Review">
        </form>
        </div>
EOF;
        echo $new_review;
        # New Comments Form End

        # close database connection
        mysqli_close($db);

        ?>
    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>