<?php include('header.php'); ?>

<div style="width:100%">
	<div class="wrapper" style="width: 50%; background-color: white;">
		<div class="wrapper" style="border: 1px solid grey; padding-top: 15%; padding-bottom: 10%; padding-left: 1%; padding-right: 1%; max-width:300px; min-width:150px">
			<?php
				if(isset($_SESSION['signIn']))
				{
					?>
					<div class="wrapper text-center" style="margin-top:1%">
						<?php
						echo $_SESSION['signIn'];
						unset($_SESSION['signIn']);
						?>
					</div>
					<?php
				}
				else if(isset($_SESSION['signUp']))
				{
					?>
					<div class="wrapper text-center" style="margin-top:1%">
						<?php
						echo $_SESSION['signUp'];
						unset($_SESSION['signUp']);
						?>
					</div>
					<?php
				}
			?>
			<div class="wrapper text-center" style="width: 60%;">
				<h1 style="font-weight: bold;">Sign Up<h1>
			</div>
			<form style="margin: 3%" action="signupCode.php" method="POST">
				<div class="mb-3">
					<div style="padding-left: 1%"><label>First Name</label></div>
					<input type="text" class="form-control" name="fname" required placeholder="Enter first name" style="width: 90%; margin-top:2%">
				</div>
				<div class="mb-3">
					<div style="padding-left: 1%"><label>Last Name</label></div>
					<input type="text" class="form-control" name="lname" required placeholder="Enter last name" style="width: 90%; margin-top:2%">
				</div>
				<div class="mb-3">
					<div style="padding-left: 1%"><label>NU E-mail</label></div>
					<input type="email" class="form-control" name="email" required placeholder="Enter email" style="width: 90%; margin-top:2%">
				</div>
				<div class="mb-3">
					<div style="padding-left: 1%"><label>Password</label></div>
					<input type="password" class="form-control" name="password" required placeholder="Enter password" style="width: 90%; margin-top:2%">
				</div>
				<div class="mb-3">
					<input type="submit" value="Sign Up" name="signupBtn" style="margin-top: 5%; width:100%" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

<div class="clearfix">

</div>

<?php include('footer.php'); ?>
