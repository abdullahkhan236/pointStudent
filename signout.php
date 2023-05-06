<?php
	include('header.php');
	unset($_SESSION['signedin']);
	header('location: index.php');
	include('footer.php');
?>