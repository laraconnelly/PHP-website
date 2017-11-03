<?php
$page_title = 'Administration - Pets R Us';

require 'templates/header.php';
require 'templates/navigation.php';
require 'templates/dbconnect.php';
?>

<section id="content">
    <div id="introText">
        <h2>Administration</h2>
        <p>Introduction to Pets R Us administration page. It has survived not only five centuries, but also the leap into
            electronic
            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing. </p>
    </div>
    <section id="administration">

        <ul>
            <li><a href="blog_admin.php">Blogs</a>&nbsp;&nbsp;<a href="news_admin.php">News</a></li>
            <li><a href="products_admin.php">Products</a>&nbsp;&nbsp;<a href="subscribe_admin.php">Subscriptions</a></li>
        </ul>

    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>