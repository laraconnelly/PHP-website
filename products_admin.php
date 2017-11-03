<?php

$page_title = 'Administration - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/form_errors.php';

$submit = $_POST['submit'];
if ($submit) {
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

    if (!$errors) {
        $sql = "INSERT INTO products (product_id, product_name, product_description, product_price, product_thumbnail, product_large_img, product_date) ";
        $sql .= " VALUES (NULL, '$product_name', '$description', '$price', '$thumbnail', '$large_img', NULL)";
        $result = $db->query($sql);
        #Send Notifications...
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $description = wordwrap($_POST['description'], 85);
        $image = "<img src='devphp.lconnelly.com/" . $_POST['thumbnail'] . "' />";
        //$image = "\nlconnelly.com/" . $_POST['thumbnail'];
        $subject = "Pets R Us Products!";
//        $message = "A Pets R Us product been posted.\n\n$image\n\n$product_name\n$price\n$description";
        $message = "A Pets R Us product been posted.<br />$image<br />$product_name<br />$price<br />$description";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: noReply@PetsRUs.com";

        $sql_mail = "SELECT email FROM subscription WHERE products=true";
        $result_mail = $db->query($sql_mail);

        while (list($email) = $result_mail->fetch_row()) {
            $recipient .= "$email, ";
        }

        mail($recipient, $subject, $message, $headers);

        # clear the sticky variables
        $product_name = "";
        $price = "";
        $thumbnail = "";
        $large_img = "";
        $description = "";
    } else {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $thumbnail = $_POST['thumbnail'];
        $large_img = $_POST['large_img'];
        $description = $_POST['description'];
    }
}

$sql = 'SELECT * FROM products ORDER BY product_id DESC';
$result = $db->query($sql);

?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us products page. It has survived not only five centuries, but also the leap into
            electronic
            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing. </p>
    </div>
    <section id="products_list">
        <?php
        echo form_errors($errors);
        $form_action = "\"products_admin.php\"";
        $form_header = "Enter Product";
        require 'templates/products_form.php';
        ?>
        <table id="products_table">
            <caption>News Items</caption>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Price</td>
                <td>Description</td>
                <td>thumbnail</td>
                <td>Date</td>
                <td>Options</td>
            </tr>
            <?php

            while (list($product_id, $product_name, $product_description, $product_price, $product_thumbnail, $product_lrg_img, $product_date) = $result->fetch_row()) {
                $sentence = strpos($product_description, ".") + 1;
                if ($sentence > 1) {
                    $product_description = substr($product_description, 0, $sentence);
                } else { #if there is no period in the content
                    if (strlen($product_description) > 30)
                        $product_description = substr($product_description, 0, 30) . "...";
                }
                $product_date = date_create($product_date);
                $product_date = date_format($product_date, 'M-d-Y');
                echo "<tr>";
                echo "<td>$product_id</td>
                    <td class='headline'> <a href='products_show.php?product_id=$product_id'>$product_name</a> </td>
                    <td> $product_price </td>
                    <td class='content'> $product_description </td>
                  	<td> <img  src='$product_thumbnail' alt='product image' /></td>
                  	<td class='date'> $product_date</td>
                    <td> <a href='products_delete.php?product_id=$product_id'>Delete</a>&nbsp;&nbsp;
                    <a href='products_update.php?product_id=$product_id'>Update</a></td>";
                echo "</tr>";
            }
            mysqli_close($db);
            ?>
        </table>

    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>