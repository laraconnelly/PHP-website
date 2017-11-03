<?php
//stored in browser
// created a cookie of name=Monster and gave it the value=40.
$name = "Monster";
$value = 40;
$expire = time() + (60 * 60 * 24 * 7);

setcookie($name, $value, $expire);

echo "<pre>";
    print_r($_COOKIE);
echo "</pre>";

//to turn off cookies - set to a blank value
//setcookie($name, null);
////to turn off cookies(extra sure it's off) - set to a blank value and a negative time
//setcookie($name, null, time() - 5000);

?>