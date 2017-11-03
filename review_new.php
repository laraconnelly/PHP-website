<?php
ob_start();
require 'templates/dbconnect.php';

$r_author = mysqli_real_escape_string($db, $_POST['r_author']);
$review = mysqli_real_escape_string($db, $_POST['review']);
$rate = $_POST['rate'];
$product_id = $_POST['product_id'];
$submit = $_POST['submit'];

if ($submit){
    $sql = "INSERT INTO reviews (review_id, r_author, review, r_date, rate, product_id)
            VALUES (NULL, '$r_author', '$review', NULL, '$rate', '$product_id')";
    $result = $db->query($sql);
};

ob_clean();

header("Location: products_show.php?product_id=$product_id");

ob_end_flush();
?>