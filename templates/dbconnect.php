<?php
$message = "";   //empty variable for any db error message
$db = new mysqli(
    'mysql.lconnelly.com',    //host name
    'larcon7',                //username
    'Tweety@@2',              //password
    'lconnelly');             //database name
if ($db->connect_error){              // the -> is a way to call the connect_error function
    $message = $db->connect_error;
}
echo $message;
?>