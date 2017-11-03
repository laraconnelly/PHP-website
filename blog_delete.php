<?php
require 'templates/dbconnect.php';
$blog_id = $_GET['blog_id'];
$sql = "DELETE FROM blogs WHERE blog_id=$blog_id";
$result = $db->query($sql);
mysqli_close($db);
$now = time();
header("Location: blog.php?t=$now&confirm=deleted");
?>


