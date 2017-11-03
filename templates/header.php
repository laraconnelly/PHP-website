<?php
    session_start();
    $default = 'Pets R Us';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?php if (isset($page_title)) {
                    echo $page_title;
                 } else {
                    echo $default;
                 } ?></title>
    <link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/nav.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/home.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />
<?php
if ($page_title == 'Contact Us - Pets R Us') {
    echo '<link rel="stylesheet" href="css/contactus.css" type="text/css" media="screen" />';
}
if ($page_title == 'Calendar - Pets R Us') {
    echo '<link rel="stylesheet" href="css/calendar.css" type="text/css" media="screen" />';
}
if ($page_title == 'Blog - Pets R Us') {
    echo '<link rel="stylesheet" href="css/blog.css" type="text/css" media="screen" />';
}
if ($page_title == 'Login'){
    echo '<link rel="stylesheet" href="css/login.css" type="text/css" media="screen"/>';
}
if ($page_title == 'Pets R Us'){
    echo '<link rel="stylesheet" href="css/subscribe.css" type="text/css" media="screen"/>';
}
if ($page_title == 'Administration - Pets R Us' || $page_title == 'News - Pets R Us'){
    echo '<link rel="stylesheet" href="css/news.css" type="text/css" media="screen"/>';
    echo '<link rel="stylesheet" href="css/products.css" type="text/css" media="screen"/>';
    echo '<link rel="stylesheet" href="css/admin.css" type="text/css" media="screen"/>';
    echo '<link rel="stylesheet" href="css/subscribe.css" type="text/css" media="screen"/>';
}
if ($page_title == 'Products - Pets R Us'){
    echo '<link rel="stylesheet" href="css/products.css" type="text/css" media="screen"/>';
}
?>
</head>
<body>
<section id="container">
    <header>
        <h1>Welcome to Pets R Us</h1>
    </header>