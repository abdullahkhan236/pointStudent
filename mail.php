<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$code=rand(100,999);
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	//Server settings                     //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'project197186284@gmail.com';                     //SMTP username
	$mail->Password   = 'Fast123!';                               //SMTP password
	$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
	$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom('project197186284@gmail.com', 'No-reply');
	$mail->addAddress("$email");     //Add a recipient
	//Optional name

	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = 'Verification code';
	$mail->Body    = "Code is: $code";
	$mail->AltBody = "Code is: $code";

	$mail->send();
}
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}?>
<div class="wrapper" style="width: 50%; background-color: white;">
	<div class="wrapper" style="border: 1px solid grey; padding-top: 15%; padding-bottom: 10%; padding-left: 1%; padding-right: 1%; max-width:300px; min-width:150px">
		<div class="wrapper text-center" style="width: 60%;">
			<h1 style="font-weight: bold;">Sign Up<h1>
		</div>
		<?php
			if (isset($_SESSION['signUp1'])) {
				echo $_SESSION['signUp1'];
			}
		?>
		<form style="margin: 3%" action="signupCode.php" method="GET">
			<div class="mb-3">
				<div style="padding-left: 1%"><label>Code</label></div>
				<input type="number" class="form-control" name="vcode" required placeholder="Enter Verification Code" style="width: 90%; margin-top:2%">
			</div>
			<div class="mb-3">
				<?php $_SESSION['code']=$code; ?>
				<input type="submit"  placeholder="submit" value="submit" name="mailBtn" style="margin-top: 5%; width:100%" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
