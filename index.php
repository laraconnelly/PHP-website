<?php
  $page_title = 'Pets R Us';

    #include header
    require 'templates/header.php';
    #include navigation
    require 'templates/navigation.php';
 ?>

    <section id="content">
        <div id="introText">
            <p>Introduction to Pets R Us.  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing. </p>
        </div>
        <section id="product_info">
            <p id="product_description">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.  Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.  It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing.  Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
            <article id="grain_free">
                <h2>Benefits of Grain Free Dog Food</h2>
                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.  Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.  It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing.  Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
            </article>
            <img id="kitten_puppy" src="images/kitten_puppy.png" alt="Kitten and Puppy" title="Kitten and Puppy" />
            <aside id="all_natural">
                <h2>Interested in our all-natural pet products?</h2>
                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.  Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            </aside>
        </section>
      <section id="subscribe">
        <?php
            $form_action = "../templates/subscribe.php";
            $header_action = "index.php";
            require 'templates/subscribe.php' ?>
      </section>
    </section>

<?php require 'templates/footer.php'; ?>
</section>
</body>
</html>