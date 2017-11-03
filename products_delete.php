<?php
require 'templates/dbconnect.php';
$product_id = $_GET['product_id'];
$sql = "DELETE FROM products WHERE product_id=$product_id";
$result = $db->query($sql);
mysqli_close($db);
header("Location: products_admin.php?confirm=deleted");
?>