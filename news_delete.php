<?php
require 'templates/dbconnect.php';
$news_id = $_GET['news_id'];
$sql = "DELETE FROM news WHERE news_id=$news_id";
$result = $db->query($sql);
mysqli_close($db);
header("Location: admin.php?confirm=deleted");
?>