<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>View Rooms</title>
</head>

<body>


    <?php
    include "checksession.php";
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";    
    echo '<div id="content">';
    include "config.php";

    $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

    if (mysqli_connect_errno()) {
        echo "Error:Unable to connect to MySql." . mysqli_connect_error();
        exit; //stop processing the page further.
    }



    //prepare a query and send it to the server

    $query = 'SELECT roomID, roomname, roomtype, beds FROM room ORDER BY roomID';
    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);
    ?>



    <h1>Room Listing</h1>
    <h2>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']  == 1) { ?>

            <a href="addroom.php">[Add a Room]</a>

        <?php } ?>

        <a href="index.php">[Return to the main page]</a>
    </h2>

    <table border="1">
        <thead>
            <tr>
                <th>Room Name</th>
                <th>Room Type</th>
                <th>Action</th>

            </tr>
        </thead>

        <!-- .PHP_EOL can be "\n"
    represents the endline character for the current system -->
        <?php
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['roomID'];
                

                echo '<tr><td>' . $row['roomname'] . '</td><td>' . $row['roomtype'] . '</td>';

                echo '<td><a href="viewroom.php?id=' . $id . '">[view]</a>';

                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
                    echo '<a href="editroom.php?id=' . $id . '">[edit]</a>';
                    echo '<a href="deleteroom.php?id=' . $id . '">[delete]</a></td>';
                }

                echo '</tr>' . PHP_EOL;
            }
        } else echo "<h2>No room found!</h2>";
        echo "</table>";

        mysqli_free_result($result); //free any memory used by the query
        mysqli_close($DBC);
        ?>
        <?php
        if (isset($_SESSION['username'])) {
            if (isset($_POST['logout'])) logout();

            $un = $_SESSION['username'];
            if ($_SESSION['loggedin'] == 1) { ?>


                <h6>Logged in as <?php echo $un ?></h6>


                <form class="form_settings" method="post">
                    <input class="submit" type="submit" name="submit" value="Logout">
                </form>


        <?php
            }
        }
        ?>

</body>
<?php
echo '</div></div>';
include "footer.php";
?>
<style>
    <?php include "style/style.css"; ?>
    </style>

</html>