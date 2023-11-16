<?php
	$servername = "localhost";
	$username = "root";
	$password = "mysqladminpassword";
	$dbname = "Xperience_db";
	session_start();
	error_reporting(0); //prevent users from seeing my fuck ups
	
	// Get data to display available timeslots
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	//extract information from db
	
	//get run number, start and end dates
	$query = "SELECT MAX(run_number) FROM `xperiencerun`";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$run_number = stripslashes($row['MAX(run_number)']);
	
	$query = "SELECT * FROM `xperiencerun` WHERE run_number='".$run_number."'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$start_date = stripslashes($row['start_date']);
	$end_date = stripslashes($row['end_date']);
	$session1_start = stripslashes($row['session1_start']);
	$session1_end = stripslashes($row['session1_end']);
	$session2_start = stripslashes($row['session2_start']);
	$session2_end = stripslashes($row['session2_end']);
	$session3_start = stripslashes($row['session3_start']);
	$session3_end = stripslashes($row['session3_end']);
	$session4_start = stripslashes($row['session4_start']);
	$session4_end = stripslashes($row['session4_end']);
	$session5_start = stripslashes($row['session5_start']);
	$session5_end = stripslashes($row['session5_end']);
	$session6_start = stripslashes($row['session6_start']);
	$session6_end = stripslashes($row['session6_end']);
	$maxslotpersession = stripslashes($row['maxslotpersession']);
	
	//dump timings into array
	$starttimings = array($session1_start,$session2_start, $session3_start, $session4_start, $session5_start, $session6_start);
	$endtimings = array($session1_end,$session2_end, $session3_end, $session4_end, $session5_end, $session6_end);
	
	//check for last session number
	$max_session = 1;
	if ($session6_start !== "00:00:00"){
		$max_session = 6;
	} else if ($session5_start !== "00:00:00"){
		$max_session = 5;
	} else if ($session4_start !== "00:00:00"){
		$max_session = 4;
	} else if ($session3_start !== "00:00:00"){
		$max_session = 3;
	} else if ($session2_start !== "00:00:00"){
		$max_session = 2;
	} else {
		$max_session = 1;
	}
	$runningdays = (strtotime($end_date) - strtotime($start_date))/86400 + 1;
	$today = date("Y-m-d");
	$slotusagearray = array(array(),array(),array(),array(),array(),array());
	//reading for used up slots
 	for ($i = 1; $i < ($max_session + 1); $i ++){
		for ($j = 0; $j < $runningdays; $j++){
			$query = "SELECT COUNT(run_number) AS counted FROM `participantsbooking` WHERE run_number='".$run_number."' AND dateslot='".date("y/m/d" ,strtotime($start_date)+ 86400*$j)."' AND timeslot= ".$i."";
			$result = $conn->query($query);
			$row = $result->fetch_assoc();
			$val = stripslashes($row['counted']);
			$slotusagearray[$i-1][$j] = $val;
			if( date("D" ,strtotime($start_date)+ 86400*$j) == 'Sat' OR date("D" ,strtotime($start_date)+ 86400*$j) == 'Sun'){
				$slotusagearray[$i-1][$j] = $maxslotpersession;
			}
		}
	} 
	$conn->close();
	
	//Get booking if available
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$loginid = addslashes($_SESSION['valid_user']);
	//get run number, user info
	$query = "SELECT * FROM `participantsbooking` WHERE run_number= '".$run_number."' AND loginid='".$loginid."'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	if($row['dateslot'] == NULL){
		$olddateslot = "Nothing booked";
		$oldtimeslot = "Nothing booked";
	} else {
		$olddateslot = stripslashes($row['dateslot']);
		$oldtimeslot = stripslashes($row['timeslot']);
	}
	
	$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Xperience</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="CSS_style.css">
</head>
<body>
	<div id="wrapper">
		<header>
			<div class="center">
				<div class="column"><a href="index.html"><img src="Logo.png" alt="Xperience"></a></div>
				<div class="column"><img src="triangle.png" alt="Triangle"></div>
				<div class="column"><img src="triangleblue.png" alt="Triangle"></div>
				<div class="column"><img src="triangle.png" alt="Triangle"></div>
				<div class="column"><img src="triangleblue.png" alt="Triangle"></div>
				<div class="column"><img src="triangle.png" alt="Triangle"></div>
			</div>
		</header>
		<div id="navrow">
			<nav>
				<ul>
					<li><a href="index.html">About Us</a></li>
					<li><a href="projects.html">Project Highlights</a></li>
					<li><a href="partnership.html">Past Partnership</a></li>
					<li><a href="book.html" style="color:#5AA9E9">Book Now!</a></li>
					<li><a href="contact.html">Contact Us</a></li>
				</ul>
			</nav>
		</div>
		<div id="content">
		<?php
		  if (isset($_SESSION['valid_user']))
		  {
			echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';
			echo '<a href="logout2.php" id="button">Log Out</a><br />';
		  }
		  else
		  {
			if (isset($userid))
			{
			  // if they've tried and failed to log in
			  echo 'Could not log you in.<br />';
			}
			else 
			{
			  // they have not tried to log in yet or have logged out
			  echo 'You are not logged in.<br />';
			}
		  }
		?>
			<div id="rowcontent">
				<div id="left2">
					<div id="Enquire">
						<h3> Book Now! </h3>
						<form action=
						<?php 
							if($olddateslot == "Nothing booked"){
								echo '"bookinglockin.php"';
							}else{
								echo '"bookingupdate.php"';
							}?>  
							method="post" id="bookingform">
							<table border="0">
								<tr>
									<td>Date: </td> 
									<td><?php echo $olddateslot;?></td> 
								</tr>
								<tr>
									<td>Session: </td>
									<td><?php echo $oldtimeslot;?></td> 
								</tr>
								<tr>
									<td>NTU Email: </td>
									<td>
										<input type="text" name="NTUEmail" id="NTUEmail" required placeholder = "Enter your NTU Email here">
									</td>
								</tr>
								<tr>
									<td>Date Slot: </td>
									<td>
										<input type="date" name="DateSlot" id="DateSlot" required value=<?php echo date("Y-m-d")?> min=<?php echo max($start_date, date("Y-m-d" ,strtotime($today) + 86400));?> max=<?php echo $end_date;?>>
									</td>
								</tr>
								<tr>
									<td>Time Slot: </td>
									<td>
										<select name="TimeSlot" required id="TimeSlot">
											<?php 
												for ($i = 1; $i < ($max_session + 1); $i ++) {
													echo "<option value =".$i.">Session ".$i."</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<input type="hidden" name="run_number" id="run_number" value=<?php echo $run_number; ?>>
								<input type="hidden" name="loginid" id="loginid" value=<?php echo $_SESSION['valid_user']; ?>>
								<tr>
									<td colspan="2" align="right">
										<input type="submit" value=
											<?php 
												if($olddateslot == "Nothing booked"){
													echo '"Confirm Booking!"';
												}else{
													echo '"Update Booking!"';
												}?>  
										id="submitbutton" onclick="return validateForm();">
									</td>
								</tr>
							</table>
						</form>
<script type='text/javascript'>								
			function init() {
				// Confirm that document.getElementById() can be used:
				if (document && document.getElementById) {
					var bookingform = document.getElementById('bookingform');
					bookingform.onsubmit = validateForm();
				}
			}
			// Function called when the form is submitted.
			// Function validates the form data and returns a Boolean value.
			function validateForm() {
				'use strict';
				// Get references to the form elements:
				var NTUEmail = document.getElementById('NTUEmail').value;
				var DateSlot = document.getElementById('DateSlot').value;
				var TimeSlot = document.getElementById('TimeSlot').value;
				var run_number = document.getElementById('run_number').value;
				// Validate email
				if ( (NTUEmail.search(/@(e.ntu.edu.sg)/) > 5) || (NTUEmail.search(/@(ntu.edu.sg)/) > 3)) {
					//proceed
				} else {
					alert('Incorrect Email!');
					return false;
				}
			}
</script>
			</div>
				</div>
				<div id="right2">
					<h3> Available Timeslots </h3>
					<div style="overflow-x:auto;">
						<table border="3">
							<tr>
								<th rowspan="2"></th>
								<?php 
									for ($j = 0; $j < $runningdays; $j++){									
										echo"<th>".date("D" ,strtotime($start_date)+ 86400*$j)."</th>"; 
									}
								?>
							</tr>
							<tr>
								<?php 
									for ($j = 0; $j < $runningdays; $j++){									
										echo"<th>".date("d/m" ,strtotime($start_date)+ 86400*$j)."</th>"; 
									}
								?>
							</tr>
							<?php 
								for ($i = 1; $i < ($max_session + 1); $i ++) {
									echo "
									<tr>
										<td>
											Session ".$i.": </br>
											".date("H:i", strtotime($starttimings[$i - 1]))."-".date("H:i", strtotime($endtimings[$i - 1]))."
										</td>";
										for ($j = 0; $j < $runningdays; $j++){
											if ($maxslotpersession-$slotusagearray[$i-1][$j]>0){	
												echo"<td>".($maxslotpersession-$slotusagearray[$i-1][$j])."</td>";
											} else {
												echo"<td>0</td>";
											}
										}
									"</tr>";
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<small><i>Copyright &copy; 2023<br>
			<a href="contact.html">Xperience@EEE</a></i></small>
		</footer>
	</div>
</body>
</html>