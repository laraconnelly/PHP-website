<?php
  $page_title = 'Calendar - Pets R Us';

#include header
require 'templates/header.php';
#include navigation
require 'templates/navigation.php';
require 'templates/utilities.php';

?>
<section id="content">
    <div id="introText">
        <p>Introduction to Pets R Us. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
            galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but
            also the leap into electronic typesetting. </p>
    </div>
    <section id="calendar">

        <div>
            <?php

            # call my calendar function
            $month = $_GET['month'];
            $year = $_GET['year'];

            if (empty($month)) {
                $month = date('m');
            }

            if (empty($year)) {
                $year = date('Y');
            }

            calendar($month, $year);
            //calendar(2, 2014);

            ?>
        </div>


    </section>
</section>

<?php require 'templates/footer.php'; ?>

</section>
</body>
</html>