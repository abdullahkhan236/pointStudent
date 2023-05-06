<?php

include('connection.php');
if(isset($_POST['signupBtn']))
{
	$email = $_POST['email'];
	$_SESSION['email'] = $email;
	$password = md5($_POST['password']);
	$_SESSION['password'] = $password;
	$fname = $_POST['fname'];
	$_SESSION['fname'] = $fname;
	$lname = $_POST['lname'];
	$_SESSION['lname'] = $lname;
	$parts = explode('@', $email);
	$_SESSION['id'] = $parts[0]; 

	if($email == NULL or $password == NULL or $fname == NULL or $lname == NULL)
	{
		?>
			<script>
				alert("Enter All Required Values.")
				window.location.href = "signup.php";
			</script>
		<?php
	}

	elseif($parts[1] != 'nu.edu.pk')
	{
		?>
			<script>
				alert("Enter NU Email.")
				window.location.href = "signup.php";
			</script>
		<?php
	}

	elseif(mysqli_num_rows(mysqli_query($conn, "select * from users where email = '$email'")) >= 1)
	{
		$_SESSION['signIn'] = "Email already registered";
		unset($_SESSION['signedin']);
		header('Location: index.php');
	}

	else
	{
		include 'mail.php';
	}
}
elseif (isset($_GET['mailBtn']))
{
	$vcode = $_GET['vcode'];
	$code = $_SESSION['code'];
	$email = $_SESSION['email'];
	$password = $_SESSION['password'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
	$id = $_SESSION['id']; 
	
	if ($vcode == $code) {
		$sql = "INSERT INTO users set ID = '$id', First_Name = '$fname', last_Name = '$lname', type = 'student', email = '$email', password = '$password'";

		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if($res)
		{
			$_SESSION['signUp'] = "Sign Up successful!";
			unset($_SESSION['code']);
			unset($_SESSION['email']);
			unset($_SESSION['password']);
			unset($_SESSION['fname']);
			unset($_SESSION['lname']);
			unset($_SESSION['id']);
			$_SESSION['signedin'] = $id;
			
			header('Location: index.php');
		}
		else
		{
			$_SESSION['signUp'] = "Try Again";
			header('Location: signup.php');
		}
	}
	else{
		$_SESSION['signUp1'] = "Try Again";
		include 'mail.php';
	}
}
?>
