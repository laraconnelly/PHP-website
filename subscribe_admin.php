<?php

$page_title = 'Administration - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
require 'templates/form_errors.php';



$sql = 'SELECT * FROM subscription ORDER BY subscription_id DESC';
$result = $db->query($sql);

?>

<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us subscription page. It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
            release of Letraset sheets containing. </p>
    </div>
    <section id="subscription_list">
        <?php
        $form_action = "../templates/subscribe.php";
        $header_action = "subscribe_admin.php";
        require 'templates/subscribe.php';
        ?>
        <table id="subscription_table">
            <caption>Subscriptions</caption>
            <tr>
                <td>ID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>News</td>
                <td>Products</td>
                <td>Options</td>
            </tr>
            <?php

            while (list($subscription_id, $first_name, $last_name, $email, $news, $products) = $result->fetch_row()) {
                $news ? $news = "YES" : $news = "NO";
                $products ? $products = "YES" : $products = "NO";
                echo "<tr>";
                echo "<td>$subscription_id</td>
                    <td> $first_name </td>
                    <td> $last_name </td>
                    <td> $email </td>
                    <td> $news </td>
                  	<td> $products </td>
                  	<td> <a href='subscribe_update.php?subscription_id=$subscription_id'>Update</a>&nbsp;&nbsp;
                  	     <a href='subscribe_delete.php?subscription_id=$subscription_id'>Delete</a></td>";
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