<?php
	$servername = "localhost";
	$username = "root";
	$password = "mysqladminpassword";
	$dbname = "Xperience_db";

	error_reporting(0);
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$Name=$_POST['Name'];
	$EmailID=$_POST['EmailID'];
	$EnquiryType=$_POST['EnquiryType'];
	$Enquiry=$_POST['Enquiry'];
	date_default_timezone_set("Asia/Singapore");
	
	$to = "eeelead@ntu.edu.sg";
	$subject = "Xperience@EEE Enquiry";

	$message = "
	<html>
		<head>
			<title>Xperience@EEE Enquiry</title>
		</head>
	<body>
		<table>
			<tr>
				<th>Date of Enquiry:</th>
				<th>".date("d-m-Y H:i:s")."</th>
			</tr>
			<tr>
				<td>Name:</td>
				<td>".$Name."</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>".$EmailID."</td>
			</tr>
			<tr>
				<td>Enquiry Type:</td>
				<td>".$EnquiryType."</td>
			</tr>
			<tr>
				<td>Enquiry:</td>
				<td>".$Enquiry."</td>
			</tr>
		</table>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <'.$EmailID.'>' . "\r\n";

	mail($to,$subject,$message,$headers);

	if (($Name !== NULL) & ($EmailID !== NULL) & ($EnquiryType !== NULL) & ($Enquiry !== NULL)) {
		$Name = addslashes($Name);
		$EmailID = addslashes($EmailID);
		$EnquiryType = addslashes($EnquiryType);
		$Enquiry = addslashes($Enquiry);
		$query = "INSERT INTO `enquirydata`(`EnquiryDateTime`,`Name`, `Email`, `EnquiryType`, `Enquiry`) VALUES ('".date("Y-m-d H:i:s")."','".$Name."','".$EmailID."','".$EnquiryType."','".$Enquiry."')";
		$result = $conn->query($query);	
	}
	$conn->close();
	echo '<script>
			alert("Your enquiry has been submitted.");
			location.href ="contact.html";
		</script>';
?>