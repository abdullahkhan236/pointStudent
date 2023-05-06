<?php
    include('connection.php');
	if(isset($_POST['AddBooking']))
	{
		foreach($_POST['Chkbox'] as $Chk)
        {
            $R_No = $Chk;
        }
		$s = $_POST['AddBooking'];
        $s = ltrim($s);
		$s = rtrim($s);
		$id = $_SESSION['signedin'];
        $rows = mysqli_query($conn, "SELECT * FROM bookings");
		$bid = mysqli_num_rows($rows)+1;

		$rows = mysqli_query($conn, "SELECT * FROM bookings WHERE Student_ID = '$id'");
		if (mysqli_num_rows($rows)>0)
        {
            $_SESSION['addbooking'] = "User already has a pre existing booking";
			header('Location: booking.php');
            exit;
        }
        $s = mysqli_fetch_array(mysqli_query($conn, "SELECT Stop_No FROM stops WHERE Stop_Name = '$s'"));
		$sql = "INSERT INTO bookings set
                Booking_ID = $bid,
				Route_No = $R_No,
                Student_ID = '$id',
				Stop_No = $s[0]";

		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if($res)
		{
			$_SESSION['addbooking'] = "Booking succesfully created... See admin for payment and confirmation";
			header('Location: index.php');
		}
		else
		{
			$_SESSION['addbooking'] = "Booking failed";
			header('Location: booking.php');
		}
	}
?>