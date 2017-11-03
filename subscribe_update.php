<?php
ob_start();
$page_title = 'Administration - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/form_errors.php';

$subscription_id = $_GET['subscription_id'];
$submit = $_POST['submit'];

if ($submit) {

    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $news = $_POST['news'];
    $news ? $news = 1 : $news = 0;
    $products = $_POST['products'];
    $products ? $products = 1 : $products = 0;

    $sql = "UPDATE subscription SET first_name='$first_name', last_name='$last_name', email='$email', news=$news, products=$products WHERE subscription_id=$subscription_id";
    $result = $db->query($sql);

    mysqli_close($db);
    ob_clean();
    header("Location: ../subscribe_admin.php");

}else{

?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us subscription page. It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
            release of Letraset sheets containing. </p>
    </div>
    <section id="subscription_list">
        <?php
        $form_action = "subscribe_update.php?subscription_id=$subscription_id";
        $header_action = "subscribe_admin.php";
        require 'templates/subscribe.php';
        ?>

    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>
<?php
}
?>