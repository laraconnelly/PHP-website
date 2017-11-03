

<?php  if ($_SESSION['admin'] == true){     ?>

            <nav id="topNav_admin">
                <ul>
                    <li><a href="index.php" title="Home">Home</a></li>
                    <li><a href="products.php" title="Products">Products</a></li>
                    <li><a href="news.php" title="News">News</a></li>
                    <li><a href="blog.php" title="Blog">Blog</a></li>
                    <li><a href="calendar.php" title="Calendar">Calendar</a></li>
                    <li><a href="admin.php" title="Administration" id="admin">Administration</a></li>
                    <?php
                    if ($_SESSION['name']){
                        echo "<li><a href=\"logout.php\" title=\"Logout\">Logout</a></li>";
                    }else{
                        echo "<li><a href=\"login.php\" title=\"Login\">Login</a></li>";
                    };
                    ?>
                </ul>
            </nav>
<?php   } else {  ?>
        <nav id="topNav">
            <ul>
                <li><a href="index.php" title="Home">Home</a></li>
                <li><a href="products.php" title="Products">Products</a></li>
                <li><a href="news.php" title="News">News</a></li>
                <li><a href="blog.php" title="Blog">Blog</a></li>
                <li><a href="calendar.php" title="Calendar">Calendar</a></li>
                <?php
                if ($_SESSION['name']){
                    echo "<li><a href=\"logout.php\" title=\"Logout\">Logout</a></li>";
                }else{
                    echo "<li><a href=\"login.php\" title=\"Login\">Login</a></li>";
                };
                ?>
            </ul>
        </nav>
<?php   }   ?>