<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=	, initial-scale=1.0">
    <title>Book a Room</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script>
        //insert datepicker jQuery

        $(document).ready(function() {
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });
            $(function() {
                checkin = $("#checkin").datepicker()
                checkout = $("#checkout").datepicker()

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

    <script>
        $(document).ready(function() {
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });

            $(function() {
                $("#from_date").datepicker();
                $("#to_date").datepicker();
            });

            $('#search').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                if (from_date != '' && to_date != '') {
                    $.ajax({
                        url: "bookingsearch.php",
                        method: "POST",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        },
                        success: function(data) {
                            $('#search_table').html(data);
                        }
                    });
                } else {
                    alert("Please Select Date");
                }
            });
        });
    </script>

</head>

<body>

    <?php
    include "checksession.php";
    checkUser();
    loginStatus();
    include "ChromePhp.php";
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";
    

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




    //on submit check if empty or not string and is submited by POST
    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Book')) {

        $room = cleanInput($_POST['room']);
        $customer = $_POST['customer'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $contact = cleanInput($_POST['contactnumber']);
        $extra = cleanInput($_POST['extra']);

        $error = 0; //clear our error flag
        $msg = 'Error: ';
        $in = new DateTime($checkin);
        $out = new DateTime($checkout);

        if ($in >= $out) {
            $error++;
            $msg .= "Arrival date cannot be earlier or equal to departure date";
            $arr = '';
        }

        if ($error == 0) {
            //save the booking data if the error flag is still clean
            $query = "INSERT INTO `booking` (roomID, customerID, checkindate, checkoutdate, contactnumber, booking_extra) VALUES (?,?,?,?,?,?)";

            $stmt = mysqli_prepare($DBC, $query); //prepare the query
            mysqli_stmt_bind_param($stmt, 'iissss', $room, $customer, $checkin, $checkout, $contact, $extra);

            ChromePhp::log($room);
            ChromePhp::log($customer);
            ChromePhp::log($checkin);
            ChromePhp::log($checkout);
            ChromePhp::log($contact);
            ChromePhp::log($extra);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            //print message
            echo "<h5>Booking added successfully</h5>";
        } else {
            //print error 
            echo "<h5>$msg</h5>" . PHP_EOL;
        }
    }


    $query1 = 'SELECT customerID, fname, lname, email FROM customer ORDER BY customerID';
    $result1 = mysqli_query($DBC, $query1);
    $rowcount1 = mysqli_num_rows($result1);


    $query = 'SELECT roomID, roomname, roomtype, beds FROM room ORDER BY roomID';
    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);

    ?>
    <h1>Book a Room</h1>
    <h2>
        <a href='bookinglisting.php'>[Return to the booking listing]</a>
        <a href="index.php">[Return to the main page]</a>
    </h2>


    <form class="form_settings" method="POST">
        <p>
            <label for="room">Rooms(name,type,beds):</label>
            <select name="room" id="room">
                <?php
                if ($rowcount > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['roomID']; ?>

                        <option value="<?php echo $row['roomID']; ?>">
                            <?php echo $row['roomname'] . ' '
                                . $row['roomtype'] . ' '
                                . $row['beds'] ?>
                        </option>
                <?php }
                } else echo "<option>No room found</option>";
                mysqli_free_result($result);
                ?>
            </select>
        </p>


        <br>
        <p>
            <label for="customer">Customers:</label>
            <select name="customer" id="customer">
                <?php
                if ($rowcount1 > 0) {
                    while ($row = mysqli_fetch_assoc($result1)) {
                        $id = $row['roomID']; ?>

                        <option value="<?php echo $row['customerID']; ?>">
                            <?php echo $row['customerID'] . ' '
                                . $row['fname'] . ' '
                                . $row['lname'] . ' - '
                                . $row['email']

                            ?>
                        </option>
                <?php }
                } else echo "<option>No room found</option>";
                mysqli_free_result($result1);
                ?>
            </select>
        </p>
        <br>
        <p>
            <label for="checkin">Checkin Date:</label>
            <input type="text" id="checkin" name="checkin" placeholder="yyyy-mm-dd" required>
        </p>
        <br>
        <p>
            <label for="checkout">Checkout Date:</label>
            <input type="text" id="checkout" name="checkout" placeholder="yyyy-mm-dd" required>
        </p>
        <br>
        <p>
            <label for="contactnumber">Contact Number:</label>
            <input type="text" id="contactnumber" name="contactnumber" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="###-###-####" required>
        </p>
        <br>
        <p>
            <label for="extra">Booking Extras:</label>
            <textarea name="extra" id="extra" cols="05" rows="2"></textarea>
        </p>
        <br>
        <p>
            <input class="submit" type="submit" name="submit" value="Book">
        </p>

    </form>
    <br>

    <hr>

    <h3>Search for room</h3>
    <div>
        <form id="searchForm" method="post" name="searching">


            <input type="text" id="from_date" name="sqa" required placeholder="From Date">
            <input type="text" id="to_date" name="sqb" required placeholder="To Date">
            <input type="submit" name="search" id="search" value="Search">

        </form>
    </div>
    

    <br><br>

    <script>
        $(document).ready(function() {
            $('#searchForm').submit(function(event) {
                var formData = {
                    sqa: $('#from_date').val(),
                    sqb: $('#to_date').val()
                };
                $.ajax({
                    type: "POST",
                    url: "bookingsearch.php",
                    data: formData,
                    dataType: "json",
                    encode: true,

                }).done(function(data) {
                    var tbl = document.getElementById("tblbookings"); //find the table in the HTML  
                    var rowCount = tbl.rows.length;

                    for (var i = 1; i < rowCount; i++) {
                        //delete from the top - row 0 is the table header we keep
                        tbl.deleteRow(1);
                    }

                    //populate the table
                    //data.length is the size of our array

                    for (var i = 0; i < data.length; i++) {
                        var fid = data[i]['roomID'];
                        var fn = data[i]['roomname'];
                        var dl = data[i]['roomtype'];
                        var tl = data[i]['beds'];
                        //create a table row with four cells
                        //Insert new cell(s) with content at the end of a table row 
                        //https://www.w3schools.com/jsref/met_tablerow_insertcell.asp  
                        tr = tbl.insertRow(-1);
                        var tabCell = tr.insertCell(-1);
                        tabCell.innerHTML = fid; //roomID
                        var tabCell = tr.insertCell(-1);
                        tabCell.innerHTML = fn; //room name  
                        var tabCell = tr.insertCell(-1);
                        tabCell.innerHTML = dl; //room type       
                        var tabCell = tr.insertCell(-1);
                        tabCell.innerHTML = tl; //beds          
                    }
                });
                event.preventDefault();
            })
        })
    </script>
    <div class="row">
        <table id="tblbookings" border="1">
            <thead>
                <tr>
                    <th>Room#</th>
                    <th>Room Name</th>
                    <th>Room Type</th>
                    <th>Beds</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php
    mysqli_close($DBC); //close the connection once done  // Displaying Selected Value
    echo '</div></div>';
    include "footer.php";
    ?>
</body>
<style>
    <?php include "style/style.css"; ?>
</style>

    
</html>