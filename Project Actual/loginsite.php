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

	//Verify Login
	$userNameInput=$_POST['UserName'];
	$passwordInput=$_POST['Password'];
	$query = "SELECT * FROM `logincredentials` WHERE userName= '".$userNameInput."' AND userPass= '".md5($passwordInput)."'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$userrights = stripslashes($row['rights']);
	$conn->close();
	if ($userNameInput !== NULL){
		if($userrights == "student"){	
			session_start();
			$_SESSION['valid_user'] = $userNameInput;
			header("Location: mainbookingsite.php?".session_id());
			exit();
		} else if($userrights == "admin"){	
			session_start();
			$_SESSION['valid_admin'] = $userNameInput;
			header("Location: adminbookingsite.php?".session_id());
			exit();
		} else {
			echo '<script>
				alert("Unauthorized Access!");
				location.href ="loginsite.php";
			</script>';
		}
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
		<div id="content" style="height: 400px">
			<div id="rowcontent">
				<div id="left">
					<div class="container">
						<img src="NTULogin.png" alt="NTU Login" width= 450px>
					</div></a>
				</div>	
				<div id="right">
					<div id="Enquire">
						<form action="loginsite.php" method="post" id="loginform">
							<table border="0">
								<tr>
									<td colspan="2">
										<h3>Nanyang Technological University</h3>
									</td>
								</tr>
								<tr>
									<td>NTU Login ID: </td>
									<td>
										<input type="text" name="UserName" id="UserName" required placeholder = "Enter your NTU ID here">
									</td>
								</tr>
								<tr>
									<td>Password: </td>
									<td>
										<input type="password" name="Password" id="Password" required placeholder = "password">
									</td>
								</tr>
								<tr>
									<td colspan="2" align="right">
										<input type="submit" value="Login!" id="submitbutton">
									</td>
								</tr>
							</table>
						</form>
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