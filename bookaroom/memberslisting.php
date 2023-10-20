<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>View Customers</title>
</head>
<body>
    <h1>Customer Listing</h1>
    <h2>
    <a href="registercustomer.php">[Create new customer]</a>
    <a href="index.php">[Return to the main page]</a>
    </h2>

    <?php
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";    
    echo '<div id="content">';
    include "checksession.php";
    include "config.php";
        $DBC = mysqli_connect(DBHOST,DBUSER,DBPASSWORD,DBDATABASE);

        if(mysqli_connect_errno()){
        echo "Error:Unable to connect to MySql." .mysqli_connect_error();
        exit;
        }

       
        // preparing query and sending it to the server
        $query = 'SELECT customerID, fname, lname, email FROM customer ORDER BY customerID';
        $result = mysqli_query($DBC,$query);
        $rowcount = mysqli_num_rows($result);
    ?>

    <h2>Customer lists</h2>
    <table border="1">
    <thead>
        <tr>
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>
    </thead>
    

    <!-- .PHP_EOL can be "\n"
     which represents the endline character for the current system -->
    <?php
       if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
         if($rowcount > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row['customerID'];
                echo '<tr><td>' .$row['customerID']
                .'</td><td>' .$row['fname']
                .'</td><td>' .$row['lname']
                .'</td><td>' .$row['email'] .'</td>';
                

                echo '</tr>' .PHP_EOL;
            }
        } else echo "<h2>NO customers found!</h2>";

        mysqli_free_result($result);
        mysqli_close($DBC);
    }
    ?>
    </table>



</body>
<?php
echo '</div></div>';
include "footer.php";
?>
<style>
    <?php include "style/style.css"; ?>
    </style>
</html>