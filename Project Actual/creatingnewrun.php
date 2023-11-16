<?php
	$servername = "localhost";
	$username = "root";
	$password = "mysqladminpassword";
	$dbname = "Xperience_db";
	
	//error_reporting(0); //prevent users from seeing my fuck ups
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$start_date=$_POST['start_date'];
	$end_date=$_POST['end_date'];
	$session1_start=$_POST['session1_start'];
	$session1_end=$_POST['session1_end'];
	$session2_start=$_POST['session2_start'];
	$session2_end=$_POST['session2_end'];
	$session3_start=$_POST['session3_start'];
	$session3_end=$_POST['session3_end'];
	$session4_start=$_POST['session4_start'];
	$session4_end=$_POST['session4_end'];
	$session5_start=$_POST['session5_start'];
	$session5_end=$_POST['session5_end'];
	$session6_start=$_POST['session6_start'];
	$session6_end=$_POST['session6_end'];
	$maxslotpersession=$_POST['maxslotpersession'];
	date_default_timezone_set("Asia/Singapore");
	if (($start_date !== NULL) & ($end_date !== NULL) & ($session1_start !== NULL) & ($session1_end !== NULL)) {
		$start_date = addslashes($start_date);
		$end_date = addslashes($end_date);
		$session1_start = addslashes($session1_start);
		$session1_end = addslashes($session1_end);
		if (($session2_start !== NULL) & ($session2_end !== NULL)){
			$session2_start = addslashes($session2_start);
			$session2_end = addslashes($session2_end);
		}
		if (($session3_start !== NULL) & ($session3_end !== NULL)){
			$session3_start = addslashes($session3_start);
			$session3_end = addslashes($session3_end);
		}
		if (($session4_start !== NULL) & ($session4_end !== NULL)){
			$session4_start = addslashes($session4_start);
			$session4_end = addslashes($session4_end);
		}
		if (($session5_start !== NULL) & ($session5_end !== NULL)){
			$session5_start = addslashes($session5_start);
			$session5_end = addslashes($session5_end);
		}
		if (($session6_start !== NULL) & ($session6_end !== NULL)){
			$session6_start = addslashes($session6_start);
			$session6_end = addslashes($session6_end);
		}
		$maxslotpersession = addslashes($maxslotpersession);
		$query = "INSERT INTO `xperiencerun`(`start_date`,`end_date`, `session1_start`, `session1_end`, `session2_start`, `session2_end`, `session3_start`, `session3_end`, `session4_start`, `session4_end`, `session5_start`, `session5_end`, `session6_start`, `session6_end`, `maxslotpersession`) VALUES ('".$start_date."','".$end_date."','".$session1_start."','".$session1_end."','".$session2_start."','".$session2_end."','".$session3_start."','".$session3_end."','".$session4_start."','".$session4_end."','".$session5_start."','".$session5_end."','".$session6_start."','".$session6_end."','".$maxslotpersession."')";
		$result = $conn->query($query);	
	}
	$conn->close();
	
	echo '<script>
			alert("Your enquiry has been submitted.");
			location.href ="adminbookingsite.php";
		</script>';
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
	</div>
</body>
</html>