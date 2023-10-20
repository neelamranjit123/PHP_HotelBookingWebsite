<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booking Details</title>
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

    //checking if the id exists or not
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $id = $_GET['id'];
        if (empty($id) or !is_numeric($id)) {
            echo "<h2>Invalid booking id</h2>";
            exit;
        }
    }

    $query = 'SELECT booking.bookingID, room.roomname, room.roomtype, room.beds, 
booking.checkindate, booking.checkoutdate, booking.contactnumber, booking.booking_extra, booking.review FROM `booking`
INNER JOIN `room` ON booking.roomID=room.roomID WHERE bookingID=' . $id;

    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);
    ?>

    <!-- Adding a menu bar to go back -->
    <h1>Booking Details View</h1>
    <h2><a href="bookinglisting.php">[Return to the booking listing]</a>
        <a href="index.php">[Return to the main page]</a>
    </h2>
    <?php
    if ($rowcount > 0) {
        echo "<fieldset><legend>Booking Detail #$id</legend><dl>";
        $row = mysqli_fetch_assoc($result);

        echo "<dt>Room name: </dt><dd>" . $row['roomname'] . "</dd>" . PHP_EOL;
        echo "<dt>Room Type: </dt><dd>" . $row['roomtype'] . "</dd>" . PHP_EOL;
        echo "<dt>Beds: </dt><dd>" . $row['beds'] . "</dd>" . PHP_EOL;
        echo "<dt>Checkin Date: </dt><dd>" . $row['checkindate'] . "</dd>" . PHP_EOL;
        echo "<dt>Checkout Date: </dt><dd>" . $row['checkoutdate'] . "</dd>" . PHP_EOL;
        echo "<dt>Contact Number: </dt><dd>" . $row['contactnumber'] . "</dd>" . PHP_EOL;
        echo "<dt>Booking Extra: </dt><dd>" . $row['booking_extra'] . "</dd>" . PHP_EOL;
        echo "<dt>Review: </dt><dd>" . $row['review'] . "</dd>" . PHP_EOL;
        echo '</dl></fieldset>' . PHP_EOL;
    } else echo "<h5>No booking found! Possbily deleted!</h5>";
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