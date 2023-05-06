<!DOCTYPE html>
<html lang="en">
	<?php
		// include('connection.php');
	?>
	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Point</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="JS/JavaScript.js"></script>
		<script type="text/javascript" src="JS/jQuery.md5.js"></script>
	</head>

	<body>
		<section class="Nav">
			<div class="Logo">
					<a href="index.php"><img src="Images/Logo1.png" alt="Logo" style="width:50px; margin:10px"></a>
			</div>
			<div class="menu text-right">
				<ul>
					<li>
						<a href="booking.php">Book</a>
					</li>
					<li>
						<a href="checkBooking.php">Check Booking</a>
					</li>
					<li>
						<a href="confirmBooking.php">Confirm Booking</a>
					</li>
					<?php if (isset($_SESSION['signedin']))
					{
						?>
						<li>
	                        <a href="signout.php">Sign Out</a>
	                    </li>
						<?php
					}
					else if (!isset($_SESSION['signedin']))
					{
						?>
						<li>
	                        <input type="button" class="btn btn-primary" value="Sign In" onclick="toggle('signin')">
	                    </li>
						<?php
					}
					?>
				</ul>
			</div>
			<div class="popup" id="signin" style="">
				<input type="button" class="btn-cls" value="&times;" onclick="closebtn('signin')">	
				<div class="container text-left">
					<form action="signin.php" method="post">
						<label>E-mail</label>
						<input type="text" name="email" required placeholder="Enter Email Address" style="">
						<label for="">Password</label>
						<input type="password" name="password" required placeholder="Enter Password" style="">
						<input type="submit" class="form-btn text-center" value="Sign In" name="SignInBtn">
					</form>
				</div>
				<div class="" style="margin-left: 100px;">
					<a href="signup.php" style="color: blue;">Sign Up</a>
				</div>
			</div>
			<?php
				if(isset($_SESSION['signIn']))
				{
					?>
					<div style="margin: 2% 5%">
						<?php
							echo $_SESSION['signIn'];
							unset($_SESSION['signIn']);
						?>
					<?php
					if(!isset($_SESSION['signedin']))
					{
					?>
					</div>
						<script>
							toggle('signin');
						</script>
					<?php
					}
				}
				
				if(isset($_SESSION['signUp']))
				{
					?>
					<div style="margin: 2% 5%">
						<?php
							echo $_SESSION['signUp'];
							unset($_SESSION['signUp']);
						?>
					</div>
					<?php
				}

				if(isset($_SESSION['addbooking']))
				{
					?>
					<div class="wrapper" style="margin-top:1%">
						<?php
						echo $_SESSION['addbooking'];
						unset($_SESSION['addbooking']);
						?>
					</div>
					<?php
				}

				if(isset($_SESSION['confirmbooking']))
				{
					?>
					<div class="wrapper" style="margin-top:1%">
						<?php
						echo $_SESSION['confirmbooking'];
						unset($_SESSION['confirmbooking']);
						?>
					</div>
					<?php
				}
			?>
		</section>

		<div class="classfix"></div>
		
		<div class="Background"></div>