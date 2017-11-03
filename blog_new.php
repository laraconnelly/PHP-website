<?php
ob_start();

$page_title = 'Blog - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/form_errors.php';

$title = mysqli_real_escape_string($db, $_POST['title']);
$author = mysqli_real_escape_string($db, $_POST['author']);
$content = mysqli_real_escape_string($db, $_POST['blog_content']);
#$current_date = date('m/d/Y');

$submit = $_POST['submit'];

if ($submit) {

    # checking for presence of content in form fields
    if (!isset($title) || $title === "") {
        $errors['title'] = "Title can't be blank";
    }
    if (!isset($author) || $author === "") {
        $errors['author'] = "Author can't be blank";
    }
    if (!isset($content) || $content === "") {
        $errors['comment'] = "Comments can't be blank";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO blogs (blog_id, titles, author, content, published) VALUES (NULL, '$title', '$author', '$content', NULL)";
        $result = $db->query($sql);
        $new_blog_id = $db->insert_id;
        mysqli_close($db);
        ob_clean();
        header("Location: blog_show.php?blog_id=$new_blog_id");
    }
}
?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has
            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
            and
            scrambled it to make a type specimen book.</p>
    </div>
    <?php
    if (!empty($errors)) {
        echo form_errors($errors); //calling form_errors function then passing in the errors array from this page
    }
    ?>

    <section id="blog_input">
        <?php
        $form = <<<EOF

        <form action="blog_new.php" method="post" name="frmBlog" id="frmBlog">
            <h2>Enter New Blog</h2>
            <div id="blog_data">

                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" maxlength="100" placeholder="Title" value="$title" /><br />

                    <label for="author">Author:</label>
                    <input type="text" name="author" id="author" maxlength="100" placeholder="Author" value="$author" /><br />

                    <textarea name="blog_content" id="blog_content" rows="10" cols="90" maxlength="1000" placeholder="Blog Away...">$content</textarea>

            </div>

            <div id="buttons">
                <input type="submit" value="Enter Blog" name="submit" />
                <input type="reset" value="Clear" />
            </div>
        </form>
EOF;

        echo $form;

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