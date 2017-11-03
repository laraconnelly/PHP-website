<?
if ($form_header == "Update News") {
    $date_field =   "<label for='pub_date'>Date:</label> ";
    $date_field .=  "<input type='text' name='pub_date' id='pub_date' readonly value='$pub_date' /><br />";
}

$form = <<<EOF

        <form action=$form_action method="post" name="frmNews" id="frmNews">
            <h2>Enter News Item</h2>
            <div id="news_data">

                    <label for="headline">Headline:</label>
                    <input type="text" name="headline" id="headline" maxlength="255" placeholder="Headline" value="$headline" /><br />

                    <label for="media_contact">Media Contact:</label>
                    <input type="text" name="media_contact" id="media_contact" maxlength="255" placeholder="Media Contact" value="$media_contact" /><br />

                    <label for="media_phone">Media Phone:</label>
                    <input type="text" name="media_phone" id="media_phone" maxlength="15" placeholder="xxx.xxx.xxxx" value="$media_phone" /><br />

                    $date_field

                    <textarea name="news_content" rows="10" cols="90" maxlength="600" placeholder="News Item...">$content</textarea>

            </div>

            <div id="buttons">
                <input type="submit" value="Enter News" name="submit" />
                <input type="reset" value="Clear" />
            </div>
        </form>
EOF;

echo $form;
