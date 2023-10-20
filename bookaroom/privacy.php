<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css"  />
    <title>Privacy Statement</title>
</head>
<body>
<?php
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";    
    echo '<div id="content">';
    include "checksession.php";
    include "config.php";
        ?>
<div id="privacystatement">
    <h2> Privacy Statement </h2>
<p> We collect personal information from you, including information about your:
    <br>
•	Name
<br>
•	Contact information
<br>
•	Billing or purchase information
<br>
We collect your personal information to:
<br>
•	Record the customer details
<br>
Besides our staff, we share this information with:
<br>
•	system developer to take actions in future if required.
<br>
Providing some information is optional. If you choose not to enter Credit card details, 
we'll be unable to provide specific services.
<br>
We keep your information safe by storing it in encrypted files and only allow to the concern staffs.
You have the right to ask for a copy of any personal information we hold about you, and to ask 
for it to be corrected if you think it is wrong. If you’d like to ask for a copy of your information, or to 
have it corrected, 
<br>
please contact us at admin@ongaongabnb.co.nz, or +64 3 323 3258, or 
100 Elizabeth Street, Riccarton, Christchurch 8008.
</p>


    </div>
    
    </body>
    <?php
echo '</div></div>';
include "footer.php";
?>
<style>
    <?php include "style/style.css"; ?>
    </style>   

    </html>