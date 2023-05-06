<?php
    include('header.php');

    if(!isset($_SESSION['signedin']))
    {
        $_SESSION['signIn'] = "Please Sign In";
		unset($_SESSION['signedin']);
		header('Location: index.php');
    }
    $id = $_SESSION['signedin'];
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bookings WHERE Student_ID = '$id' AND Status = 0")) > 0)
    {
        $res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE ID = '$id'"));
        $password = $res['Password'];
        ?>
        <div style="width:50%; margin: 2% auto; min-height: 20vh;">
            <input class="btn" type="password" placeholder="Confirm password" id="password" style="border:1px solid black; width:80%;">
            <button class="btn btn-primary" type="submit" id="submit" style="">Submit</button>
            
            <div class="wrapper" id="confirm" style="display:none;">
                <form action="confirmCode.php" method="post">
                    YOU'RE ABOUT TO MAKE PAYMENT OF PKR. 20,000!
                    <input class="btn" type="number" required placeholder="Enter Card Number" name="card" style="border:1px solid black; margin:2% auto; width:80%">
                    <input class="btn" type="text" required placeholder="Enter Card Holder Name" name="name" style="border:1px solid black; margin:2% auto; width:80%">
                    <input class="btn" type="date" required placeholder="Enter Expiry Date" name="date" style="border:1px solid black; width:35%; float: left; margin:2% 0 2% 10%">
                    <input class="btn" type="number" required placeholder="Enter CVS Number" name="cvs" style="border:1px solid black; width:35%; float: right; margin:2% 10% 2% 0">
                    <div class="clearfix"></div>
                    <button class="btn btn-primary" type="submit" id="submit1" name="submit" style="float:right; margin-right:10%">Submit</button>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php
    }
    elseif(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bookings WHERE Student_ID = '$id'")) <= 0)
    {
        ?><br><?php echo "No booking exists for user. ";?><a href="booking.php">Click here </a>to book in point. Or<a href="Index.php"> here </a>to go back to home page.<br><br><br><br><br><br><br><br><br><br><?php
    }
    elseif(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bookings WHERE Student_ID = '$id' AND Status = 1")) > 0)
    {
        ?><br><?php echo "Booking already confirmed for user. ";?><a href="checkBooking.php">Click here </a>to check booking details. Or<a href="Index.php"> here </a>to go back to home page.<br><br><br><br><br><br><br><br><br><br><?php
    }

    include('footer.php')
?>

<script>
    $('#submit').click(function(){
        var pass = $.md5($('#password').val());
        $('#password').prop('disabled', true);
        $('#submit').prop('disabled', true);
        if(pass == <?php echo json_encode($password); ?>)
        {
            toggle('confirm');
        }
    });
</script>