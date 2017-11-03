<?php
$page_title = 'Contact Us - Pets R Us';
require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/form_errors.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$question = $_POST['question'];
$contact_by = $_POST['contact_by'];
$product = $_POST['product'];
$submit = $_POST['submit'];

//checking for presence of content in form fields
if ($submit) {
    #required fields
    if (!isset($name) || $name === "") {
        $errors['name'] = "Name can't be blank";
    }
    if (!isset($email) || $email === "") {
        $errors['email'] = "Email can't be blank";
    }

    #radio buttons
    $check = 'checked="checked"';
    if ($contact_by == 'phone') {
        $by_phone = $check;
    } elseif ($contact_by == 'email') {
        $by_email = $check;
    }

    #dropdown menu
    $select = 'selected="selected"';
    if ($product == 'kitten_food') {
        $kitten_food = $select;
    } elseif ($product == 'dog_treats') {
        $dog_treats = $select;
    } elseif ($product == 'parakeet_toys') {
        $parakeet_toys = $select;
    } elseif ($product == 'other') {
        $other = $select;
    } else {
        $none_selected = $select;
    }

//    #checkboxes
//    if (isset($_POST['promotional'])) {
//        foreach ($_POST['promotional'] as $promotional) {
//            if ($promotional == 'newsletter') $newsletter_check = $check;
//            if ($promotional == 'new_products') $new_products_check = $check;
//        }
//    }

    if (empty($errors)){
        require 'templates/dbconnect.php';

        //send notification to user
        $subject = "Pets R Us Contact Us";
        $message = "Thank you for for contacting Pets R Us. \nYour questions are very important to us. \nSincerely,\nPets R Us";
        $headers = "From: noReply@PetsRUs.com";
        //mail($email, $subject, $message, $headers);

        //send notification to administrators
        $subject = "Pets R Us: New Contact Us request submitted";
        $message =  "$name has submitted the following information on the Contact Us page.";
        $message .= "name: $name \n email: $email \n phone: $phone";
        $message .= "question: $question \n product: $product";
echo $message;
        $headers = "From: noReply@PetsRUs.com \r\n BCC: karen.kelly@scc.spokane.edu";
echo $headers;
        $sql_admin_mail = "SELECT admin_email FROM users WHERE admin=1";
        $result_admin_mail = $db->query($sql_admin_mail);

        while (list($admin_email) = $result_admin_mail->fetch_row()) {
            $recipient .= "$admin_email, ";
        }
echo $recipient;
        //mail($recipient, $subject, $message, $headers);
    }
}

?>

<section id="content">

    <?php
    require 'templates/contactus_form.php';

    #to output _POST array...
    #print_r($_POST);
    #print_r($_POST['promotional']);

    #Output the submitted form data
    if (isset($submit)) {
        echo form_errors($errors); //calling form_errors function then passing in the errors array from this page
    }

    ?>

</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>