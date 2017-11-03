<?php
//sessions are stored on server not person's browser, automatically expire when session closes
//    may need to write a method to have sessions deleted from server after a certain period of time
//    otherwise they will continue to add up

session_start();
$_SESSION["name"] = Monster;
$test_name = $_SESSION["name"];
echo $test_name;

// to turn off sessions
    $_SESSION["name"] = null;

?>
