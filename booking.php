<?php
	include('Connection.php');
	if (!isset($_SESSION['signedin']))
	{
		$_SESSION['signIn'] = "Please Sign In";
		unset($_SESSION['signedin']);
		header('Location: index.php');
	}
	else
	{
		$id = $_SESSION['signedin'];
		include('header.php');
	}
	if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bookings WHERE Student_ID = '$id'"))>0)
	{
		?><br><?php echo "Booking already exists for user. ";?><a href="checkBooking.php">Click here </a>to check booking details. Or<a href="Index.php"> here </a>to go back to home page.<br><br><br><br><br><br><br><br><br><br><?php
	}
	else
	{
		if(isset($_POST['ajax']) && isset($_POST['id']))
		{
			// echo 'Boyakashah';
			$stop1 = $_POST['id'];
			$stop1 = ltrim($stop1);
			$stop1 = rtrim($stop1);
			$routes = array();
			$res = mysqli_query($conn, "SELECT * FROM routes_stops WHERE Stop_No = (SELECT Stop_No FROM stops WHERE Stop_Name = '$stop1')");
			echo 'Route';
			while($row = mysqli_fetch_array($res))
			{
				array_push($routes, $row['Route_No']);
				echo $row['Route_No'];
				echo ',';
			}
			$res = mysqli_query($conn, "SELECT * FROM routes_stops WHERE Stop_No = (SELECT Stop_No FROM stops WHERE Stop_Name = '$stop1')");
			echo 'Time';
			while($row = mysqli_fetch_array($res))
			{
				echo $row['Time'];
				echo ',';
			}
			echo 'Uni';
			foreach($routes as $route)
			{
				$res = mysqli_query($conn, "SELECT * FROM routes_stops WHERE Route_No = $route AND Stop_No = (SELECT Stop_No FROM stops WHERE Stop_Name = 'FAST University')");
				while($row = mysqli_fetch_array($res))
				{
					echo $row['Time'];
					echo ',';
				}
			}
			// foreach($row as $route)
			// {
			// 	array_push($routes, $route);
			// }
			// print_r($routes);
			exit;
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
		$res = mysqli_query($conn, "SELECT * FROM stops");
		$stops = array();
		while($row = mysqli_fetch_array($res))
		{
			array_push($stops, $row['Stop_Name']);
		}
	?>

	<div class="wrapper" style="">
		<select class="btn" name="" id="stopsss" style="border:1px solid black; margin:0 0 0 20%; width:60%">
			<option value="">--Select your stop--</option>
			<?php 
			foreach($stops as $stop)
			{ ?>
				<option value=" <?php echo $stop ?> "> <?php echo $stop ?> </option> <?php 
			} ?>
		</select>
		<button class="btn btn-primary" id="btns">Submit</button>
	</div>

	<div class="clearfix"></div>

	<div class="wrapper" id="bookingContainer">
		<form action="book.php" method="post" id="bookingForm">
			<!-- <input class="form-check-input" type="checkbox" style="" > -->
			<table class="tbl-full" id="bookingTable">
				<tr>
					<th>#</th>
					<th>Route No.</th>
					<th>Stop</th>
					<th>Time</th>
					<th>Dest.</th>
					<th>Time</th>
				</tr>
			</table>
			<br>
			<button type="submit" name="AddRoute" class="btn btn-primary" style="float:right; margin-right:1%;  margin-left: 0">Book</button>
		</form>
	</div>

	<div class="clearfix"></div>

	<script>
		$("#btns").click(function(){

			var stop = $('#stopsss').find(":selected").text();

			$.ajax({
				type: 'post',
				data: {ajax: 1, id: stop},
				success: function(response){
					response = response.split('Route');
					all = response[1].split('Time');
					routes = all[0].split(',');
					all = all[1].split('Uni');
					times = all[0].split(',');
					unitimes = all[1].split(',');

					$('#bookingForm').remove();
					for(i=0;i<routes.length-1;i++)
					{
						var formheaders = '<form action="book.php" method="post">\
							<table class="tbl-full" id="bookingTable">\
								<tr>\
									<th>#</th>\
									<th>Route No.</th>\
									<th>Stop</th>\
									<th>Time</th>\
									<th>Dest.</th>\
									<th>Time</th>\
								</tr>\
							</table>\
							<br>\
							<button type="submit" value="'+stop+'" name="AddBooking" class="btn btn-primary" style="float:right; margin-right:1%;  margin-left: 0">Book</button>\
						</form>'
						var formfields = '<tr class="rows">\
							<td><input class="form-check-input" type="checkbox" value="'+routes[i]+'" name="Chkbox[]" style="margin: auto; width:1000%" ></td>\
							<td>'+routes[i]+'</td>\
							<td>'+stop+'</td>\
							<td>'+times[i]+'</td>\
							<td>FAST University</td>\
							<td>'+unitimes[i]+'</td>\
						</tr>';
						if(i == 0)
						{
							$('#bookingContainer').append(formheaders);
						}
						$('#bookingTable').append(formfields);
					}
				}
			} );
			
			

			// for(i=0; i<routes.length; i++)
			// {
			// 	$('#bookingTable').append(formfields);
			// }
		});
	</script>
<?php } 
	include('footer.php');
?>