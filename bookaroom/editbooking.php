<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

    <script>
        //insert datepicker jQuery

        $(document).ready(function() {
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });
            $(function() {
                checkIn = $("#checkin").datepicker()
                checkOut = $("#checkout").datepicker()

                function getDate(element) {
                    var date;
                    try {
                        date = $.datepicker.parseDate(dateFormat, element.value);
                    } catch (error) {
                        date = null;
                    }
                    return date;
                }
            });
        });
    </script>
</head>

<body>
    <?php
    include "checksession.php"; 
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";
    echo '<div id="content">';

    //take the details about server and database
    include "config.php"; //load in any variables
    $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

    //insert DB code from here onwards
    //check if the connection was good
    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
        exit; //stop processing the page further
    }

    //function to clean input but not validate type and content
    function cleanInput($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    //check if id exists
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $id = $_GET['id'];
        if (empty($id) or !is_numeric($id)) {
            echo "<h2>Invalid booking id</h2>";
            exit;
        }
    }

    //on submit check if empty or not string and is submited by POST
    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Update')) {

        $room = cleanInput($_POST['room']);

        $checkIn = $_POST['checkin'];
        $checkOut = $_POST['checkout'];
        $contactnumber = cleanInput($_POST['contactnumber']);
        $extra = cleanInput($_POST['extra']);
        $id = cleanInput($_POST['id']);
        $upd = "UPDATE `booking` SET roomID=?, checkindate=?, checkoutdate=?, contactnumber=?, booking_extra=? WHERE BookingID=?";
        $stmt = mysqli_prepare($DBC, $upd); //prepare the query
        mysqli_stmt_bind_param($stmt, 'issssi', $room, $checkIn, $checkOut, $contactnumber, $extra, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        //print message
        echo "<h5>Booking updated successfully</h5>";
    }

    $query = 'SELECT booking.bookingID, room.roomID, room.roomname, room.roomtype, room.beds, booking.checkindate, booking.checkoutdate, booking.contactnumber, booking.booking_extra FROM `booking`
INNER JOIN `room` ON booking.roomID=room.roomID WHERE bookingID=' . $id;

    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);
    ?>

    <h1>Update Booking</h1>
    <h2>
        <a href='bookinglisting.php'>[Return to the Booking listing]</a>
        <a href="index.php">[Return to the main page]</a>
    </h2>


    <form method="POST">
        <div>
            <label for="room">Rooms:</label>
            <select name="room" id="room">
                <?php
                if ($rowcount > 0) {
                    $row = mysqli_fetch_assoc($result)
                ?>

                    <option value="<?php echo $row['roomID']; ?>">
                        <?php echo $row['roomname'] . ' '
                            . $row['roomtype'] . ' '
                            . $row['beds'] ?>
                    </option>

                <?php
                } else echo "<option>No rooms found</option>";
                ?>

            </select>
        </div>

        <div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">

        </div>

        <br>

        <br>
        <div>
            <label for="checkin">Checkin Date:</label>
            <input type="text" id="checkin" name="checkin" value="<?php echo $row['checkindate'] ?>" required>
        </div>

        <br>
        <div>
            <label for="checkout">Checkout Date:</label>
            <input type="text" id="checkout" name="checkout" required value="<?php echo $row['checkoutdate'] ?>" required>
        </div>
        <br>
        <div>
            <label for="contactnumber">Contact Number</label>
            <input type="text" id="contactnumber" name="contactnumber" value="<?php echo $row['contactnumber'] ?>" required>
        </div>

        <br>
        <div>
            <label for="extra">Booking Extra:</label>
            <textarea name="extra" id="extra" value="<?php echo $row['booking_extra'] ?>" cols="30" rows="1"></textarea>

        </div>

        <br>
        <div>
            <input type="submit" name="submit" value="Update">
        </div>

    </form>

    <?php
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