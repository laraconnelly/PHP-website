<?php
require 'templates/dbconnect.php';
$subscription_id = $_GET['subscription_id'];
$sql = "DELETE FROM subscription WHERE subscription_id=$subscription_id";
$result = $db->query($sql);
mysqli_close($db);
header("Location: subscribe_admin.php?confirm=deleted");
?>