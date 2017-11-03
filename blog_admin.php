<?php
$page_title = 'Blog - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';


$sql = 'SELECT * FROM blogs ORDER BY blog_id DESC'; // query database  It's convention in sql to put key words in uppercase
$result = $db->query($sql); // use query method to query sql variable
//if ($db->error){                  //this will give us error message
//    $message = $db-> error;
//}

$confirm = $_GET['confirm'];
if ($confirm == "deleted")
    $confirm = "Blog entry successfully deleted";
else
    $confirm = "";
?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us. It has survived not only five centuries, but also the leap into electronic
            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing. </p>
    </div>
    <section id="blog_list">
        <?php
        //if ($_SESSION['name']){
            echo "<p><a href='blog_new.php'>New Blog Entry</a></p>";
       // }
        if (!empty($confirm)) echo "<p id=\"blog_delete_confirm\">$confirm</p>";
        ?>

        <table class="blog_table">
            <tr>
                <td>ID</td>
                <td>Title</td>
                <td>Author</td>
                <td>Content</td>
                <td>Publish Date</td>
                <td>Options</td>
            </tr>
            <?php
            if ($message) {
                echo "<h3>$message</h3>";
            }

            while (list($blog_id, $title, $author, $content, $pub_date) = $result->fetch_row()) {
                # show only first 30 chars of content
                if (strlen($content) > 30)
                    $content = substr($content, 0, 30) . "...";
                echo "<tr>";
                echo "<td>$blog_id</td>
                    <td> <a href='blog_show.php?blog_id=$blog_id'>$title</a></td>
                    <td> $author </td>
                    <td> $content </td>
                  	<td> $pub_date</td>
                    <td><a href='blog_show.php?blog_id=$blog_id'>Show</a>&nbsp;&nbsp;";
//                if ($_SESSION['name']){
                    echo "<a href='blog_delete.php?blog_id=$blog_id'>Delete</a>&nbsp;&nbsp;
                          <a href='blog_update.php?blog_id=$blog_id'>Update</a></td>";
//                };
                echo "</tr>";
            }

            ?>
        </table>

    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>