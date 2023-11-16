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

	//reading for used up slots
	$query = "SELECT COUNT(EnquiryType) AS counted FROM `enquirydata` WHERE EnquiryType='Booking'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$bookingenquirycount = stripslashes($row['counted']);
	$query = "SELECT COUNT(EnquiryType) AS counted FROM `enquirydata` WHERE EnquiryType='Project'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$projectenquirycount = stripslashes($row['counted']);
	$query = "SELECT COUNT(EnquiryType) AS counted FROM `enquirydata` WHERE EnquiryType='Partnership'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$partnershipenquirycount = stripslashes($row['counted']);
	$query = "SELECT COUNT(EnquiryType) AS counted FROM `enquirydata` WHERE EnquiryType='Others'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$othersenquirycount = stripslashes($row['counted']);
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
		<div id="content">
			<div id="rowcontent">
				<div id="enquirycounttable">
					<h3> Enquiry Report </h3>
					<table border="5">
						<tr>
							<th style="background-color: #444444">Enquiry Type</th>
							<th style="background-color: #444444">Enquiry Count</th>
						</tr>
						<tr>
							<th>Booking</th>
							<td><?php echo $bookingenquirycount;?></td>
						</tr>
						<tr>
							<th>Project</th>
							<td><?php echo $projectenquirycount;?></td>
						</tr>
						<tr>
							<th>Partnership</th>
							<td><?php echo $partnershipenquirycount;?></td>
						</tr>
						<tr>
							<th>Others</th>
							<td><?php echo $othersenquirycount;?></td>
						</tr>
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