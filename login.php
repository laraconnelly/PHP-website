<?php
ob_start();
session_start();

$page_title = "Login";
require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';

$user_name = $_POST['user_name'];
$user_name_display = $user_name;
$password = $_POST['password'];
$submit = $_POST['submit'];

if ($submit) {

    $user_name = mysqli_real_escape_string($db, $_POST['user_name']);
    $password = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE user_name='$user_name' AND password='$password'";
    $result = $db->query($sql);

    list($user_id, $user_name, $password, $admin) = $result->fetch_row();
    if ($user_id) {
        $_SESSION['name'] = $user_name;
        $_SESSION['admin'] = $admin;
        ob_clean();
        header("Location: index.php");
    } else {
        $login_fail = "<div id=\"failed\">";
        $login_fail .= "<p>Login failed.</p>";
        $login_fail .= "</div>";
    }

}


$login = <<<EOL

<div id="introText">
    $login_fail
    <p>Introduction to Pets R Us. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
        Ipsum has
        been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
        and
        scrambled it to make a type specimen book.</p>
</div>

<section id="login">
    <form action="login.php" method="POST" name="frmLogin" id="frmLogin">
        <h2>Login</h2>
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" value= "$user_name_display" id="user_name" placeholder="User Name" required /><br/>
        <label for="password" >Password:</label>
        <input type="password" name="password" id="password" placeholder="Password" required /><br />
        <input type="submit" name="submit" value="Submit" id="submit" />
        <input type="reset" value="Cancel" />
    </form>
</section>

EOL;

echo $login;

require 'templates/footer.php';

echo "</section>";
echo "</body>";
echo "</html>";

?>


