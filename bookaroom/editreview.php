<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Manage reviews</title>
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

        $reviews = cleanInput($_POST['review']);
        $id = cleanInput($_POST['id']);


        $upd = "UPDATE `booking` SET review=? WHERE BookingID=?";

        $stmt = mysqli_prepare($DBC, $upd); //prepare the query
        mysqli_stmt_bind_param($stmt, 'si', $reviews, $id);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        //print message
        echo "<h5>Review updated </h5>";
    }


    $query = 'SELECT  review FROM `booking` WHERE BookingID=' . $id;


    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);

    ?>
    <h1>Update Booking</h1>
    <h2>
        <a href='bookinglisting.php'>[Return to the Booking listing]</a>
        <a href="index.php">[Return to the main page]</a>
    </h2>

    <div>
        <div>
            <form method="POST">

                <div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                </div>
                <?php
                if ($rowcount > 0) {
                    $row = mysqli_fetch_assoc($result);
                ?>
                    <div>
                        <label for="review">Review:</label>
                        <textarea name="review" id="review" value="<?php echo $row['review'] ?>" cols="40" rows="5"></textarea>
                    </div>


                <?php
                } else echo "<h5>No booking found!</h5>"
                ?>
                <br> <br>

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