<?php
$page_title = 'News - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';

$sql = "SELECT * FROM news ORDER BY news_id DESC";
$result = $db->query($sql);

?>


<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us News. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
            galley of type and scrambled it to make a type specimen book.</p>
    </div>
    <section id="news_show">
        <?php
        $counter = 0;
        while ($counter < 3) {
            $counter += 1;
            list($news_id, $headline, $content, $pub_date, $media_contact, $media_phone) = $result->fetch_row();
            $pub_date = date_create($pub_date);
            $pub_date = date_format($pub_date, 'M-d-Y');
            $show = <<<EOF

        <ul>
            <li class="show_headline"><a href="news_show.php?news_id=$news_id">$headline</a></li>
            <li>Published:  $pub_date</li>
            <li>$content</li>
            <li>Media Contact: $media_contact&nbsp;&nbsp;  #$media_phone</li>

        </ul>

EOF;
            echo $show;
        }
        ?>
    </section>
    <section id="news_list">
        <table id="news_table">
            <caption>Previous News Items</caption>
            <tr>
                <td>Headline</td>
                <td>Content</td>
                <td>Publish Date</td>
                <td>Media Contact</td>
                <td>Media Phone</td>
            </tr>
            <?php

            while (list($news_id, $headline, $content, $pub_date, $media_contact, $media_phone) = $result->fetch_row()) {
                $sentence = strpos($content, ".") + 1;
                if ($sentence > 1){
                    $content = substr($content, 0, $sentence);
                }else{     #if there is no period in the content
                    if (strlen($content) > 30)
                        $content = substr($content, 0, 30) . "...";
                }
                $pub_date = date_create($pub_date);
                $pub_date = date_format($pub_date, 'M-d-Y');
                echo "<tr>";
                echo "<td class='headline'> <a href='news_show.php?news_id=$news_id'>$headline</a> </td>
                      <td class='content'> $content </td>
                  	  <td class='date'> $pub_date</td>
                  	  <td> $media_contact </td>
                  	  <td> $media_phone </td>";
                echo "</tr>";
            }
            mysqli_close($db);
            ?>
        </table>

    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>

