<?php
$page_title = 'News - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';

$news_id = $_GET['news_id'];


$sql = "SELECT * FROM news WHERE news_id=$news_id";
$result = $db->query($sql);
list($news_id, $headline, $content, $pub_date, $media_contact, $media_phone) = $result->fetch_row();
$pub_date = date_create($pub_date);
$pub_date = date_format($pub_date, 'M-d-Y');
?>


<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
            galley of type and scrambled it to make a type specimen book.</p>
    </div>
    <section id="news_show">
        <?php
        $show = <<<EOF

        <ul>
            <li class="show_headline">$headline</li>
            <li>Published:  $pub_date</li>
            <li>$content</li>
            <li>Media Contact: $media_contact&nbsp;&nbsp;  #$media_phone</li>

        </ul>

EOF;

        echo $show;

        mysqli_close($db);
        ?>

    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>

