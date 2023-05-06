<?php
    include('header.php');
    if(!isset($_SESSION['signedin']))
    {
        $_SESSION['signIn'] = "Please Sign In";
		unset($_SESSION['signedin']);
		header('Location: index.php');
    }
    $id = $_SESSION['signedin'];
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bookings WHERE Student_ID = '$id'")) > 0)
    {
        ?>
        
        <div class="wrapper" style="margin-bottom:0;">
            <div class="wrapper" id="confirmation" style="border: 1px dotted black; width: 80%; padding: 2% 2% 25% 4%; margin:5% auto 0 auto; overflow-y: auto; height: 500px">
                <div style="padding: 5% 0 0 0; margin:auto">
                    <div class="Logo" style="float: left;">
                            <a href="index.php"><img src="Images/Logo.png" alt="Logo" style="width:100px; "></a>
                    </div>
                    <div class="Logo" style="float: right;">
                            <a href="index.php"><img src="Images/Logo1.png" alt="Logo" style="width:100px;"></a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="" style="border-bottom: 1px solid black; margin:auto">
                    <?php
                        $S_ID = $_SESSION['signedin'];
                        
                        $sql = "SELECT * from users where ID = '$S_ID'";
                        $res = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_assoc($res);

                        $sql = "SELECT * from bookings where Student_ID = '$S_ID'";
                        $res = mysqli_query($conn, $sql);
                        $booking = mysqli_fetch_assoc($res);
                        $R_No = $booking['Route_No'];
                        $S_No = $booking['Stop_No'];
                        if($booking['Status'] != 0)
                        {
                            $status = 'Confirmed';
                        }
                        else
                        {
                            $status = 'Not Confirmed';
                        }

                        $sql = "SELECT * from routes where Route_No = $R_No";
                        $res = mysqli_query($conn, $sql);
                        $route = mysqli_fetch_assoc($res);

                        $sql = "SELECT * from routes_stops where Route_No = $R_No";
                        $res = mysqli_query($conn, $sql);
                        $route_stops = mysqli_fetch_assoc($res);

                        $sql = "SELECT * from stops where Stop_No = $S_No";
                        $res = mysqli_query($conn, $sql);
                        $stop = mysqli_fetch_assoc($res);

                        $sql = "SELECT * from routes_stops where Route_No = $R_No AND Stop_No = (SELECT Stop_No from stops WHERE Stop_Name = 'FAST University')";
                        $res = mysqli_query($conn, $sql);
                        $uni = mysqli_fetch_assoc($res);

                        $sql = "SELECT * from stops where Stop_Name = 'FAST University'";
                        $res = mysqli_query($conn, $sql);
                        $unistop = mysqli_fetch_assoc($res);
                    ?>
                    <div class="text-center" style="margin:1% 0; border-bottom: 1px dashed black">
                        <strong>User Details</strong>
                    </div>
                    <div style="margin:2%; width:45%; float:left">
                        <strong><label>Full Name:</label></strong>
                        <?php echo $user['First_Name']; echo " "; echo $user['Last_Name']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:right">
                        <strong><label>Student ID:</label></strong>
                        <?php echo $user['ID']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:left">
                        <strong><label>Email:</label></strong>
                        <?php echo $user['Email']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:right">
                        <strong><label>Type:</label></strong>
                        <?php echo $user['Type']; ?>
                    </div>

                    <br><br>

                    <div class="clearfix"></div>
                </div>
                <div class="" style="border-bottom: 1px solid black; margin:auto">
                    <div class="text-center" style="margin:1% 0; border-bottom: 1px dashed black">
                        <strong>Booking Details</strong>
                    </div>
                    <div style="margin:2%; width:45%; float:left">
                        <strong><label>Booking ID:</label></strong>
                        <?php echo $booking['Booking_ID']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:right">
                        <strong><label>Route No:</label></strong>
                        <?php echo $booking['Route_No']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:left">
                        <strong><label>Stop:</label></strong>
                        <?php echo $stop['Stop_Name']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:right">
                        <strong><label>Departure Time:</label></strong>
                        <?php echo $route_stops['Time']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:left;">
                        <strong><label>Arrival:</label></strong>
                        <?php echo $unistop['Stop_Name']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:right;">
                        <strong><label>Arrival Time:</label></strong>
                        <?php echo $uni['Time']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:left;">
                        <strong><label>Driver:</label></strong>
                        <?php echo $route['Driver']; ?>
                    </div>

                    <div style="margin:2%; width:45%; float:right;">
                        <strong><label>Driver's Phone:</label></strong>
                        <?php echo $route['Phone']; ?>
                    </div>

                    <div class="clearfix"></div>

                    <div style="margin-top:2%; margin-right:auto; margin-left:auto; width:45%; text-align:center;">
                        <strong><label>Status:</label></strong>
                        <?php echo $status; ?>
                    </div>

                    <br><br>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
        <div class="wrapper">
            <div style="width: 84%; margin:auto;">
                <div style="margin:0 0 2% 0; width:45%; float:right;">
                    <input type="button" class="btn btn_print" style="float: right; cursor: pointer" value="Print">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php
    }
    elseif(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bookings WHERE Student_ID = '$id'")) <= 0)
    {
        ?><br><?php echo "No booking exists for user. ";?><a href="booking.php">Click here </a>to book in point. Or<a href="Index.php"> here </a>to go back to home page.<br><br><br><br><br><br><br><br><br><br><?php
    }

    include('footer.php');
?>

<script>
    $(document).ready(function($) 
	{
		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();
            //credit : https://ekoopmans.github.io/html2pdf.js
			var element = document.getElementById('confirmation');
			
            html2pdf().set({filename: 'Booking '+<?php echo json_encode($S_ID); ?>+'.pdf'}).from(element).save();
			
		});
	});
</script>