<?php
session_start();
ob_start();
$submit = $_POST['submit'];
$subscription_id = $_GET['subscription_id'];

if ($submit) {
    require 'dbconnect.php';
//    print_r($_POST);
    $header_action =  $_POST['header_action'];
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $news = $_POST['news'];
    $news ? $news = 1 : $news = 0;
    $products = $_POST['products'];
    $products ? $products = 1 : $products = 0;

    $sql = "SELECT email FROM subscription WHERE email='$email'";
    $result = $db->query($sql);

    list($email_exists) = $result->fetch_row();

    if ($email_exists) {
        $sql = "UPDATE subscription SET news=$news, products=$products WHERE email='$email'";
        $result = $db->query($sql);
    } elseif (!empty($email)) {
        $sql = "INSERT INTO subscription (subscription_id, first_name, last_name, email, news, products) VALUES (NULL, '$first_name', '$last_name', '$email', $news, $products)";
        $result = $db->query($sql);
    }

    if (!empty($email)) {
        //send notification to users
        $subject = "Pets R Us mailing list confirmation";
        $message = "Thank you for subscribing to Pets R Us. \nKeeping you informed is our priority. \nSincerely,\nPets R Us";
        $headers = "From: noReply@PetsRUs.com";
        mail($email, $subject, $message, $headers);

        //send notification to administrators
        $subject = "Pets R Us mailing list addition";
        $message =  "$first_name $last_name has been added to the subscription list\n";
        $message .= "email: $email\n";
        $_POST['news'] ? $message .= "subscribed to: news\n": $news = 0;
        $_POST['products'] ? $message .= "subscribed to: products": $products = 0;
        $headers = "From: noReply@PetsRUs.com \r\nBCC: karen.kelly@scc.spokane.edu";
        $recipient = "IlaPayton@gmail.com";

        mail($recipient, $subject, $message, $headers);

    }

    mysqli_close($db);
    ob_clean();
    header("Location: ../$header_action");      //header_action is defined by the form that subscribe.php is embedded in
} else {
    if ($subscription_id){
        $sql = "SELECT * FROM subscription WHERE subscription_id=$subscription_id";
        $result = $db->query($sql);
        list($subscription_id, $first_name, $last_name, $email, $news, $products) = $result->fetch_row();
        $news ? $news = "checked" : $news = "";
        $products ? $products = "checked" : $products = "";
    }

    $form = <<<EOF

<form action="$form_action" method="post" name="frmSubscribe" id="frmSubscribe">

    <div id="subscribe_info">
        <fieldset><legend>Email Subscription</legend>

            <label for="first_name">First Name (Required):</label>
            <input type="text" name="first_name" id="first_name" maxlength="100" required placeholder="First Name" value="$first_name" /><br />

            <label for="last_name">Last Name (Required):</label>
            <input type="text" name="last_name" id="last_name" maxlength="100" required placeholder="Last Name" value="$last_name" /><br />

            <label for="email">Email Address (Required):</label>
            <input type="text" name="email" id="email" maxlength="50" required placeholder="Email Address" value="$email" /><br />

            <input type="checkbox" name="news" id="news" value="news" $news />
            <label for="news">Subscribe to newsletter</label><br />
            <input type="checkbox" name="products" id="products" value="products" $products />
            <label for="products">Notify me of product announcements</label><br />

            <input type="hidden" name="header_action" id="header_action" value="$header_action" /><br />

        </fieldset>
    </div>

    <div id="buttons">
        <input type="submit" value="Subscribe" name="submit" />
        <input type="reset" value="Clear" />
    </div>
        </form>
EOF;

    echo $form;
}
?>