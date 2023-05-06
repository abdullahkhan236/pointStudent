<?php

include('connection.php');
if(isset($_POST['SignInBtn']))
{
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	if($email == NULL or $password == NULL)
	{
		?>
			<script>
				alert("Enter All Required Values.")
				window.location.href = "index.php";
			</script>
		<?php
	}

	else
	{
		$sql = "SELECT * FROM users where (email = '$email' or ID = '$email') and (password = '$password') ";

		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if($res)
		{{
				$rows = mysqli_num_rows($res);
				if($rows == 1)
				{
					$data = mysqli_fetch_assoc($res);
					if($data['Type'] == 'admin')
					{
						$_SESSION['Admin'] = "admin";
						header('Location: admin/index.php');
					}
					else
					{
						$_SESSION['signedin'] = $data['ID'];
						$_SESSION['signIn'] = "Sign in succesful";
						header('Location: index.php');
					}
				}
				else
				{
					$_SESSION['signIn'] = "Email or password incorrect";
					unset($_SESSION['signedin']);
					header('Location: index.php');
				}
		
			}}
		else
		{
			$_SESSION['signIn'] = "Failed to sign in";
			unset($_SESSION['signedin']);
			header('Location: index.php');
		}
	}
}
?>