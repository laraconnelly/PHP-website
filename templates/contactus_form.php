<?php
$form = <<<EOF

        <form action="contactus.php" method="post" name="frmContactUs" id="frmContactUs">
            <h2>Contact Us</h2>
            <div id="contactInfo">
                <fieldset><legend>Contact Information</legend>

                    <label for="name">Name (Required):</label>
                    <input type="text" name="name" id="name" maxlength="100" placeholder="Name" value="$name" /><br />

                    <label for="email">Email Address (Required):</label>
                    <input type="text" name="email" id="email" maxlength="50" placeholder="Email Address" value="$email" /><br />

                    <label for="phone">Phone Number (Optional):</label>
                    <input type="text" name="phone" id="phone" maxlength="12" placeholder="Home Phone" value="$phone" /><br />

                    <label for="contact_by_phone">Preferred Contact Type:</label><br />
                    <input type="radio" name="contact_by" id="contact_by_phone" value="phone" $by_phone />
                    <label for="contact_by_phone">Phone:</label><br />
                    <input type="radio" name="contact_by" id="contact_by_email" value="email" $by_email />
                    <label for="contact_by_email">Email:</label><br />

                </fieldset>
            </div>
            <div id="products">
                <fieldset id="product_select"><legend>Product</legend>
                    <label for="product">Select a product:</label>
                    <select name="product" id="product" >
                        <option value="">--  --</option>
                        <option value="kitten_food" $kitten_food>Kitten Food</option>
                        <option value="dog_treats" $dog_treats>Dog Treats</option>
                        <option value="parakeet_toys" $parakeet_toys>Parakeet Toys</option>
                        <option value="other" $other>Other</option>
                    </select><br />
<!--
                    <input type="checkbox" name="promotional[]" id="promo_newsletter" value="newsletter" $newsletter_check />
                    <label for="promo_newsletter">Subscribe to newsletter</label><br />
                    <input type="checkbox" name="promotional[]" id="promo_new_products" value="new_products" $new_products_check />
                    <label for="promo_new_products">Notify me when new products are added</label><br />
-->
                </fieldset>
            </div>
            <div id="question_text">
                <fieldset><legend>Question</legend>
                    <textarea name="question" id="question" rows="10" cols="90" maxlength="1000" placeholder="We want to hear your questions...">$question</textarea>
                </fieldset>
            </div>


            <div id="buttons">
                <input type="submit" value="ContactUs" name="submit" />
                <input type="reset" value="Clear" />
            </div>
        </form>
EOF;

echo $form;
