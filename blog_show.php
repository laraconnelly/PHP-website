<?php
$page_title = 'Blog - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/utilities.php';

$blog_id = $_GET['blog_id'];

# get blog data for SHOW
$sql = "SELECT * FROM blogs WHERE blog_id=$blog_id"; // query database  It's convention in sql to put key words in uppercase
$result = $db->query($sql); // use query method to query sql variable
list($blog_id, $title, $author, $content, $pub_date) = $result->fetch_row();
#format date
$pub_date_timestamp = date_create($pub_date);
$pub_date_timestamp = date_format($pub_date_timestamp, 'M-d-Y g:i A');

# get average ratings for comment
$sql_rate = "SELECT AVG(rate) FROM comments WHERE blog_id=$blog_id";
$result_rate = $db->query($sql_rate);
list($avg_rating) = $result_rate->fetch_row();
$avg_rating_stars = rating_stars($avg_rating);

?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has
            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
            and
            scrambled it to make a type specimen book.</p>
    </div>
    <section id="blog_show">
        <?php
        if ($_SESSION['name']){
            echo "<p><a href='blog_update.php?blog_id=$blog_id'>Edit this blog</a></p>";
        }
$show = <<<EOF

        <ul>
            <li>$avg_rating_stars</li>
            <li id="blog_title">$title</li>
            <li>$author</li>
            <li>$content</li>
            <li>$pub_date_timestamp</li>
        </ul>

EOF;

        echo $show;

        # Query Comments Start
        $sql = "SELECT * FROM comments WHERE blog_id=$blog_id";
        $result = $db->query($sql);

        echo "<div class=\"blog_comment\">";
        echo "<h2>Comments</h2>";
        while (list($comment_id, $c_author, $comment, $rate, $c_date, $c_blog_id) = $result->fetch_row()) {
            $rating_stars = rating_stars($rate);
            $time_stamp = strtotime($c_date);
            $ago = time_elapsed_string($time_stamp);
            $comment_show = <<<EndOfComment
            <ul>
            <li>$rating_stars</li>
            <li>$c_author</li>
            <li>$comment</li>
            <li>$ago</li>
            </ul>
            <hr>
EndOfComment;
            echo $comment_show;
        };
        echo "</div>";
        # Query Comments End

        # New Comments Form
$new_comment = <<<EOF
        <div class="blog_comment">
        <h2>Your Comments are Welcome</h2>
        <form method="post" action="comment_new.php">
            <input type="hidden" name="blog_id" value="$blog_id" />
            <input type="text" name="c_author" placeholder="Author" value="$c_author" /> <br />
            <textarea name="comment" rows="5" cols="30" maxlength="500" placeholder="Enter Comment">$comment</textarea> <br />
            <select name="rate">
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select> <br />
            <input type="submit" name="submit" value="Submit Comment">
        </form>
        </div>
EOF;
        echo $new_comment;
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