<?php
    include('connection.php');
    if(isset($_POST['submit']) && isset($_SESSION['signedin']))
    {
        $id = $_SESSION['signedin'];
        if(mysqli_query($conn, "UPDATE bookings SET Status = 1 WHERE Student_ID = '$id'"))
        {
            $_SESSION['confirmbooking'] = "Booking Confirmed!";
		    header('Location: index.php');
        }
        else
        {
            $_SESSION['confirmbooking'] = "Error! Try Again";
		    header('Location: confirmbooking.php');
        }
    }
    elseif(!isset($_SESSION['signedin']))
    {
        $_SESSION['signIn'] = "Please Sign In";
		unset($_SESSION['signedin']);
		header('Location: index.php');
    }
    else
    {
        $_SESSION['confirmbooking'] = "Error! Try Again";
		header('Location: confirmbooking.php');
    }
?>