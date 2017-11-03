<?php
    session_start();
    $_SESSION['name'] = null;
    $_SESSION['admin'] = null;
    header("Location: index.php");

?>
