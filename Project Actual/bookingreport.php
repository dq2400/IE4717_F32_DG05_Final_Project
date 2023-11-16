<?php
	$servername = "localhost";
	$username = "root";
	$password = "mysqladminpassword";
	$dbname = "Xperience_db";
	
	error_reporting(0); //prevent users from seeing my fuck ups
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	//extract information from db
	$run_number = $_POST['run_number'];
	//get run number, start and end dates
	$query = "SELECT MAX(run_number) FROM `xperiencerun`";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$maxrun_number = stripslashes($row['MAX(run_number)']);
	
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
					<li><a href="book.html">Book Now!</a></li>
					<li><a href="contact.html">Contact Us</a></li>
				</ul>
			</nav>
		</div>
		<div id="content" >
			<div id="rowcontent" style="height: auto;">
				<h3> Booking Report </h3>
				<form name="menuForm" action="bookingreport.php" method="post"> 
				<select name="run_number" required id="run_number">
					<?php 
						for ($i = $maxrun_number; $i > 0; $i --) {
							echo "<option value =".$i.">Run ".$i."</option>";
						}
					?>
				</select>
				<input type="submit" value="Go">
				</form>
				</br>
				<h3>Data for run <?php echo $run_number;?></h3>
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
										if( date("D" ,strtotime($start_date)+ 86400*$j) == 'Sat' OR date("D" ,strtotime($start_date)+ 86400*$j) == 'Sun'){
											echo"<td>NA</td>";
										} else {
											echo"<td>".($slotusagearray[$i-1][$j])."</td>";
										}
									}
								"</tr>";
							}
						?>
					</table>
				</div>
			</div>
			<a href="adminbookingsite.php" id="button">Back</a> <a href="logout.php" id="button">Log Out</a>
		</div>
		<footer>
			<small><i>Copyright &copy; 2023<br>
			<a href="contact.html">Xperience@EEE</a></i></small>
		</footer>
	</div>
</body>
</html>