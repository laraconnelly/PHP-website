<?php
ob_start();

$page_title = 'Blog - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';

$blog_id = $_GET['blog_id'];
$title = mysqli_real_escape_string($db, $_POST['title']);
$author = mysqli_real_escape_string($db, $_POST['author']);
$content = mysqli_real_escape_string($db, $_POST['content']);

$submit = $_POST['submit'];

if ($submit) {
    $sql = "UPDATE blogs SET titles='$title', author='$author', content='$content' WHERE blog_id=$blog_id";
    $result = $db->query($sql);
    mysqli_close($db);
    ob_clean();
    header("Location: blog_show.php?blog_id=$blog_id");
}


$sql = "SELECT * FROM blogs WHERE blog_id=$blog_id"; // query database  It's convention in sql to put key words in uppercase
$result = $db->query($sql); // use query method to query sql variable

list($blog_id, $title, $author, $content, $pub_date) = $result->fetch_row();

?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has
            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
            and
            scrambled it to make a type specimen book.</p>
    </div>
    <section id="blog_input">
        <?php
        $form = <<<EOF

        <form action="blog_update.php?blog_id=$blog_id" method="post" name="frmBlog" id="frmBlog">
            <h2>Blog Data</h2>
            <div id="blog_data">

                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" maxlength="100" placeholder="Title" value="$title" /><br />

                    <label for="author">Author:</label>
                    <input type="text" name="author" id="author" maxlength="100" placeholder="Author" value="$author" /><br />

                    <label for="pub_date">Date:</label>
                    <input type="text" name="pub_date" id="pub_date" readonly value="$pub_date" /><br />

                    <textarea name="content" rows="10" cols="90" maxlength="1000" placeholder="Blog Away...">$content</textarea>

            </div>

            <div id="buttons">
                <input type="submit" value="Update Blog" name="submit" />
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