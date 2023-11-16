<?php
	date_default_timezone_set("Asia/Singapore");
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
			<div id="newrun" style="height: auto;">
				<div>
					<h3> Create New Run </h3>
					<p> warning: previous run will stop </p>
					<form action="creatingnewrun.php" method="post" id="newrunform">
						<table border="0">
							<tr>
								<td>Start Date: </td>
								<td>
									<input type="date" name="start_date" id="start_date" required value=<?php echo date("Y-m-d")?> min=<?php echo date("Y-m-d")?>>
								</td>
							</tr>
							<tr>
								<td>End Date: </td>
								<td>
									<input type="date" name="end_date" id="end_date" required value=<?php echo date("Y-m-d")?>>
								</td>
							</tr>
							<tr>
								<td>Session 1 Start Time: </td>
								<td>
									<input type="time" name="session1_start" id="session1_start" required>
								</td>
							</tr>
							<tr>
								<td>Session 1 End Time: </td>
								<td>
									<input type="time" name="session1_end" id="session1_end" required>
								</td>
							</tr>
							<tr>
								<td>Session 2 Start Time: </td>
								<td>
									<input type="time" name="session2_start" id="session2_start"> 
								</td>
							</tr>
							<tr>
								<td>Session 2 End Time: </td>
								<td>
									<input type="time" name="session2_end" id="session2_end"> 
								</td>
							</tr>
							<tr>
								<td>Session 3 Start Time: </td>
								<td>
									<input type="time" name="session3_start" id="session3_start"> 
								</td>
							</tr>
							<tr>
								<td>Session 3 End Time: </td>
								<td>
									<input type="time" name="session3_end" id="session3_end">
								</td>
							</tr>
							<tr>
								<td>Session 4 Start Time: </td>
								<td>
									<input type="time" name="session4_start" id="session4_start"> 
								</td>
							</tr>
							<tr>
								<td>Session 4 End Time: </td>
								<td>
									<input type="time" name="session4_end" id="session4_end"> 
								</td>
							</tr>
							<tr>
								<td>Session 5 Start Time: </td>
								<td>
									<input type="time" name="session5_start" id="session5_start"> 
								</td>
							</tr>
							<tr>
								<td>Session 5 End Time: </td>
								<td>
									<input type="time" name="session5_end" id="session5_end">
								</td>
							</tr>
							<tr>
								<td>Session 6 Start Time: </td>
								<td>
									<input type="time" name="session6_start" id="session6_start">
								</td>
							</tr>
							<tr>
								<td>Session 6 End Time: </td>
								<td>
									<input type="time" name="session6_end" id="session6_end">
								</td>
							</tr>
							<tr>
								<td>Max pax per session: </td>
								<td>
									<input type="number" name="maxslotpersession" id="maxslotpersession" min="1" max="20" required>
								</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2" align="right">
									<input type="submit" value="Confirm Run" id="submitbutton" onclick="return validateForm();">
								</td>
							</tr>
						</table>
						<script type='text/javascript'>								
							function validateForm() {
								'use strict';
								// Get references to the form elements:
								var start_date = document.getElementById('start_date').value;
								var end_date = document.getElementById('end_date').value;
								// Validate date
								if (start_date > end_date) {
									alert('Date Error!');
									return false;
								}
								
								// Get references to the form elements:
								var session1_start = document.getElementById('session1_start').value;
								var session1_end = document.getElementById('session1_end').value;
								// Validate date
								if (session1_start > session1_end) {
									alert('Time 1 Error!');
									return false;
								}
								
								// Get references to the form elements:
								var session2_start = document.getElementById('session2_start').value;
								var session2_end = document.getElementById('session2_end').value;
								// Validate date
								if(session2_start != 0 && session2_end != 0) {
									if (session2_start > session2_end) {
										alert('Time 2 Error!');
										return false;
									}
									if (session1_end > session2_start) {
										alert('Time 1, 2 Error!');
										return false;
									}
								}
								// Get references to the form elements:
								var session3_start = document.getElementById('session3_start').value;
								var session3_end = document.getElementById('session3_end').value;
								// Validate date
								if(session3_start != 0 && session3_end != 0) {
									if (session3_start > session3_end) {
										alert('Time 3 Error!');
										return false;
									}
									if (session2_end > session3_start) {
										alert('Time 2, 3 Error!');
										return false;
									}
								}
								// Get references to the form elements:
								var session4_start = document.getElementById('session4_start').value;
								var session4_end = document.getElementById('session4_end').value;
								// Validate date
								if(session4_start != 0 && session4_end != 0) {
									if (session4_start > session4_end) {
										alert('Time 4 Error!');
										return false;
									}
									if (session3_end > session4_start) {
										alert('Time 3, 4 Error!');
										return false;
									}
								}
								// Get references to the form elements:
								var session5_start = document.getElementById('session5_start').value;
								var session5_end = document.getElementById('session5_end').value;
								// Validate date
								if(session5_start != 0 && session5_end != 0) {
									if (session5_start > session5_end) {
										alert('Time 5 Error!');
										return false;
									}									
									if (session4_end > session5_start) {
										alert('Time 4, 5 Error!');
										return false;
									}
								}
								// Get references to the form elements:
								var session6_start = document.getElementById('session6_start').value;
								var session6_end = document.getElementById('session6_end').value;
								// Validate date
								if(session6_start != 0 && session6_end != 0) {
									if (session6_start > session6_end) {
										alert('Time 6 Error!');
										return false;
									}
									if (session5_end > session6_start) {
										alert('Time 5, 6 Error!');
										return false;
									}
								}
							}
						</script>
					</form>
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