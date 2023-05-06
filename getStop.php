<?php 
include('Connection.php');
$routes = array();
$stop1 = 'Model Colony';
echo gettype($stop1);
$res = mysqli_query($conn, "SELECT * FROM routes_stops WHERE Stop_No = 
									(SELECT Stop_No FROM stops WHERE Stop_Name = '$stop1')");
		while($row = mysqli_fetch_array($res))
		{
	print_r($row);
}
?>


var routes = response; 
					routes = routes.split(',');

					$('#bookingForm').remove();
					for(i=0;i<routes.length-1;i++)
					{
						var formheaders = '<form action="book.php" method="post">\
							<table class="tbl-full" id="bookingTable">\
								<tr>\
									<th>#</th>\
									<th>Route No.</th>\
									<th>Stop</th>\
									<th>Driver Name</th>\
									<th>Driver Phone No.</th>\
								</tr>\
							</table>\
							<br>\
							<button type="submit" value="'+stop+'" name="AddBooking" class="btn btn-primary" style="float:right; margin-right:1%;  margin-left: 0">Book</button>\
						</form>'
						var formfields = '<tr class="rows">\
							<td><input class="form-check-input" type="checkbox" value="'+routes[i]+'" name="Chkbox[]" style="margin: auto; width:1000%" ></td>\
							<td>'+routes[i]+'</td>\
							<td>'+stop+'</td>\
							<td>Drivers Name</td>\
							<td>Drivers Phone No.</td>\
						</tr>';
						if(i == 0)
						{
							$('#bookingContainer').append(formheaders);
						}
						$('#bookingTable').append(formfields);
					}