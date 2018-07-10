<?php
ob_start();
session_start();

include 'logout.php';

?>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="home.css">
<link href="https://fonts.googleapis.com/css?family=Acme|Allura|Amatic+SC|Berkshire+Swash|Julius+Sans+One|Kaushan+Script|Merienda|Norican" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cinzel|Cookie|Dancing+Script|Lato|Patrick+Hand+SC|Rancho|Rock+Salt" rel="stylesheet">

<div class="container" style="background-color: #333;
	color: white;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(0, 0, 0, 0.6);">
	<div class="content" style = "font-family: Merienda;
	font-size: 25px; color: white">

		<a href="student_files/student_view_profile.php">View Profile</a><br><br>
		<a href="student_files/student_edit_profile.php">Edit Profile</a><br><br>
		<a href="student_files/select_course.php">Select Courses</a><br><br>
		<a href="student_files/view_attendance.php">View Attendance</a><br>

	</div>
</div>