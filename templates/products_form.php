<?php
if ($form_header == "Update Product") {
    $date_field =   "<label for='product_date'>Product Date:</label> ";
    $date_field .=  "<input type='text' name='product_date' id='product_date' readonly value='$product_date' /><br />";

}
$form = <<<EOF

        <form action=$form_action method="post" name="frmProduct" id="frmProduct">
            <h2>$form_header</h2>
            <div id="products_data">

                    <label for="product_name">Product Name:</label>
                    <input type="text" name="product_name" id="product_name" maxlength="255" placeholder="Product Name" value="$product_name" /><br />

                    $date_field

                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price" maxlength="10" placeholder="$$$" value="$price" /><br />

                    <label for="thumbnail">Thumbnail Path:</label>
                    <input type="text" name="thumbnail" id="thumbnail" size="40" maxlength="255" value="$thumbnail" /><br />

                    <label for="large_img">Large Image Path:</label>
                    <input type="text" name="large_img" id="large_img" size="40" maxlength="255" value="$large_img" /><br />

                    <textarea name="description" rows="10" cols="90" maxlength="600" placeholder="Product Description...">$description</textarea>

            </div>

            <div id="buttons">
                <input type="submit" value="$form_header" name="submit" />
                <input type="reset" value="Clear" />
            </div>
        </form>
EOF;

echo $form;