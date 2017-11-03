<?php
ob_start();
$page_title = 'Administration - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/form_errors.php';

$news_id = $_GET['news_id'];
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
        $sql = "UPDATE news SET headline='$headline', content='$content', media_contact='$media_contact', media_phone='$media_phone' WHERE news_id=$news_id";
        $result = $db->query($sql);
        mysqli_close($db);
        ob_clean();
        header("Location: news_show.php?news_id=$news_id");
    }else {
        $headline = $_POST['headline'];
        $media_contact = $_POST['media_contact'];
        $media_phone = $_POST['media_phone'];
        $content = $_POST['news_content'];
    }
}
else {
    $sql = "SELECT * FROM news WHERE news_id=$news_id";
    $result = $db->query($sql);
    list($news_id, $headline, $content, $pub_date, $media_contact, $media_phone) = $result->fetch_row();
}

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
        $form_action = "\"news_update.php?news_id=$news_id\"";
        $form_header = "Update News";
        require 'templates/news_form.php';
        # close database connection
        mysqli_close($db);
        ob_end_flush();
        ?>
    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>