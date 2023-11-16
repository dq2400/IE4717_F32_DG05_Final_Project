<?php
	$servername = "localhost";
	$username = "root";
	$password = "mysqladminpassword";
	$dbname = "Xperience_db";

	//error_reporting(0);
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());

	}
	$NTUEmail=$_POST['NTUEmail'];
	$DateSlot=$_POST['DateSlot'];
	$TimeSlot=$_POST['TimeSlot'];
	$run_number=$_POST['run_number'];
	$loginid=$_POST['loginid'];

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
	if ($session6_start !== ""){
		$max_session = 6;
	} else if ($session5_start !== ""){
		$max_session = 5;
	} else if ($session4_start !== ""){
		$max_session = 4;
	} else if ($session3_start !== ""){
		$max_session = 3;
	} else if ($session2_start !== ""){
		$max_session = 2;
	} else {
		$max_session = 1;
	}
	$runningdays = (strtotime($end_date) - strtotime($start_date))/86400 + 1;
	
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
	$daythnumber = (strtotime($DateSlot) - strtotime($start_date))/86400;
	if(($maxslotpersession - $slotusagearray[$TimeSlot - 1][$daythnumber]) > 0){		
		//update database
		$NTUEmail = addslashes($NTUEmail);
		$DateSlot = addslashes($DateSlot);
		$TimeSlot = addslashes($TimeSlot);
		$loginid = addslashes($loginid);
		$query = "UPDATE `participantsbooking` SET `dateslot`='".$DateSlot."', `timeslot`='".$TimeSlot."' WHERE `run_number`='".$run_number."' AND `loginid`='".$loginid."'";
		$result = $conn->query($query);	
		$conn->close();
		echo '<script>
			alert("Your booking has been submitted.");
			location.href ="index.html";
		</script>';
		return true;
	} else {
		$conn->close();
		echo '<script>
				alert("Your booking has failed: No more available slots.");
				location.href ="mainbookingsite.php";
		</script>';
		return false;
	}	
	
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
	</div>
</body>
</html>