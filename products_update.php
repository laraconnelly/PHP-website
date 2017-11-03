<?php
ob_start();
$page_title = 'Administration - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/form_errors.php';

$product_id = $_GET['product_id'];
$submit = $_POST['submit'];
if ($submit){
    $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $thumbnail = mysqli_real_escape_string($db, $_POST['thumbnail']);
    $large_img = mysqli_real_escape_string($db, $_POST['large_img']);
    $description = mysqli_real_escape_string($db, $_POST['description']);

    if (!$product_name) {
        $errors['product_name'] = "Product Name";
    }
    if (!$price) {
        $errors['price'] = "Price";
    }
    if (!$description) {
        $errors['description'] = "Description";
    }

    if (!$errors){
        $sql = "UPDATE products SET product_name='$product_name', product_description='$description', ";
        $sql .= "product_price='$price', product_thumbnail='$thumbnail', product_large_img='$large_img' ";
        $sql .= "WHERE product_id=$product_id";
        $result = $db->query($sql);

        mysqli_close($db);
        ob_clean();
        header("Location: products_show.php?product_id=$product_id");
    }else {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $thumbnail = $_POST['thumbnail'];
        $large_img = $_POST['large_img'];
        $description = $_POST['description'];
    }
}
else {
    $sql = "SELECT * FROM products WHERE product_id=$product_id";
    $result = $db->query($sql);
    list($product_id, $product_name, $description, $price, $thumbnail, $large_img, $product_date) = $result->fetch_row();
}

?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us news page. It has survived not only five centuries, but also the leap into
            electronic
            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing. </p>
    </div>
    <section id="news_list">
        <?php
        echo form_errors($errors);
        $form_action = "\"products_update.php?product_id=$product_id\"";
        $form_header = "Update Product";
        require 'templates/products_form.php';
        mysqli_close($db);
        ob_end_flush();
        ?>
    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>