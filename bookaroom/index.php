<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    
</head>
<body>
<?php
include "checksession.php";
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "sidebar.php";

echo '<div id="content">';
include "content.php";

echo '</div></div>';
include "footer.php";
?>

    
</body>
<style>
    <?php include "style/style.css"; ?>
    </style>
</html>