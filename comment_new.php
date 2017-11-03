<?php
ob_start();
require 'templates/dbconnect.php';

$c_author = mysqli_real_escape_string($db, $_POST['c_author']);
$comment = mysqli_real_escape_string($db, $_POST['comment']);
$rate = $_POST['rate'];
$blog_id = $_POST['blog_id'];
$submit = $_POST['submit'];

if ($submit){
    $sql = "INSERT INTO comments (comment_id, c_author, comment, c_date, rate, blog_id)
            VALUES (NULL, '$c_author', '$comment', NULL, '$rate', '$blog_id')";
    $result = $db->query($sql);
};

ob_clean();

header("Location: blog_show.php?blog_id=$blog_id");

ob_end_flush();
?>