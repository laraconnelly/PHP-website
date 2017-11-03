<?php

$page_title = 'Administration - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/form_errors.php';

$submit = $_POST['submit'];

if ($submit){
    $headline = mysqli_real_escape_string($db, $_POST['headline']);
    $media_contact = mysqli_real_escape_string($db, $_POST['media_contact']);
    $media_phone = mysqli_real_escape_string($db, $_POST['media_phone']);
    $content = mysqli_real_escape_string($db, $_POST['news_content']);

    if ( !$headline){
        $errors['headline'] = "Headline";
    }
    if ( !$media_contact){
        $errors['media_contact'] = "Media Contact";
    }
    if ( !$media_phone){
        $errors['media_phone'] = "Media Phone";
    }
    if ( !$content){
        $errors['content'] = "News Content";
    }

    if (!$errors){
        $sql = "INSERT INTO news (news_id, headline, content, published, media_contact, media_phone) VALUES (NULL, '$headline', '$content', NULL, '$media_contact', '$media_phone')";
        $result = $db->query($sql);
        #Send Notifications...
        $headline = $_POST['headline'];
        $content = wordwrap($_POST['news_content'], 85);
        $media_contact = $_POST['media_contact'];
        $subject = "Pets R Us News!";
        $message = "A Pets R Us news item has been posted.\n\n$headline\n$content\n\nMedia Contact: $media_contact #$media_phone";
        $headers = "From: noReply@PetsRUs.com";

        $sql_mail = "SELECT email FROM subscription WHERE news=true";
        $result_mail = $db->query($sql_mail);

        while (list($email) = $result_mail->fetch_row()) {
            $recipient .= "$email, ";
        }

        mail($recipient, $subject, $message, $headers);

        # clear the sticky variables
        $headline = "";
        $media_contact = "";
        $media_phone = "";
        $content = "";
    }else {
        $headline = $_POST['headline'];
        $media_contact = $_POST['media_contact'];
        $media_phone = $_POST['media_phone'];
        $content = $_POST['news_content'];
    }
}

$sql = 'SELECT * FROM news ORDER BY news_id DESC';
$result = $db->query($sql);

?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us news page. It has survived not only five centuries, but also the leap into
            electronic
            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing. </p>
    </div>
    <section id="news_list">
        <?php
        echo form_errors($errors);
        $form_action = "\"admin.php\"";
        require 'templates/news_form.php';
        ?>
        <table id="news_table">
            <caption>News Items</caption>
            <tr>
                <td>ID</td>
                <td>Headline</td>
                <td>Content</td>
                <td>Publish Date</td>
                <td>Media Contact</td>
                <td>Media Phone</td>
                <td>Options</td>
            </tr>
            <?php

            while (list($news_id, $headline, $content, $pub_date, $media_contact, $media_phone) = $result->fetch_row()) {
                $sentence = strpos($content, ".") + 1;
                if ($sentence > 1){
                    $content = substr($content, 0, $sentence);
                }else{              #if there is no period in the content
                    if (strlen($content) > 30)
                        $content = substr($content, 0, 30) . "...";
                }
                $pub_date = date_create($pub_date);
                $pub_date = date_format($pub_date, 'M-d-Y');
                echo "<tr>";
                echo "<td>$news_id</td>
                    <td class='headline'> <a href='news_show.php?news_id=$news_id'>$headline</a> </td>
                    <td class='content'> $content </td>
                  	<td class='date'> $pub_date</td>
                  	<td> $media_contact </td>
                  	<td> $media_phone </td>
                    <td> <a href='news_delete.php?news_id=$news_id'>Delete</a>&nbsp;&nbsp;
                    <a href='news_update.php?news_id=$news_id'>Update</a></td>";
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