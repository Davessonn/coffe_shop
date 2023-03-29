<!DOCTYPE html>
<html>
<head>
    <meta http-equiv = "Content-Type" content = "text/html; charset = utf-8"/>
    <link rel = "stylesheet" href = "style.css"/>
    <title>Coffee shop</title>
</head>
<body>

<header>
    <h1 class="header-text">Coffee Shop</h1>
    <?php
    if(!empty($title)){	echo '<h1 class="header-text title">'.$title.'</h1>';}
    ?>
</header>