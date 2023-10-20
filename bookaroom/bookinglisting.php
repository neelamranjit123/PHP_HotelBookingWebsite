<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse booking</title>

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
        exit;
    }

    // preparing query and sending it to the server
    $query = 'SELECT bookingID, roomID, checkindate, checkoutdate FROM booking ORDER BY roomID';
    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);
    ?>

    <h1>Current booking</h1>
    <h2>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']  == 1) { ?>

            <a href="makeabooking.php">[Book a Room]</a>

        <?php } ?>

        <a href="index.php">[Return to the main page]</a>
    </h2>

    <table border="1">
        <thead>
            <tr>
                <th>Current booking(Roomname, checkindate, checkoutdate)</th>
                <th>Action</th>
            </tr>
        </thead>

        <?php
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['bookingID'];
                $ro = $row['roomID'];
                $sql = 'SELECT roomID, roomname, roomtype, beds FROM `room` WHERE roomID =' . $ro;
                $res = mysqli_query($DBC, $sql);
                $rowc = mysqli_num_rows($res);

                if ($rowc > 0) {
                    $rowr = mysqli_fetch_assoc($res);
                }

                echo '<tr><td>' . $rowr['roomname'] . ', ' . $row['checkindate'] . ', ' . $row['checkoutdate'] . '</td>';
                echo '<td><a href="bookingdetails.php?id=' . $id . '">[view]</a>';
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
                    echo '<a href="editbooking.php?id=' . $id . '">[edit]</a>';
                    echo '<a href="editreview.php?id=' . $id . '">[manage review]</a>';
                    echo '<a href="deletebooking.php?id=' . $id . '">[delete]</a></td>';
                }

                echo '</tr>' . PHP_EOL;
            }
        } else echo "<h2>No booking found!</h2>";
        echo "</table>";
        mysqli_free_result($result);
        mysqli_close($DBC);
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