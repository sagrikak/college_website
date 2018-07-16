<?php
ob_start();
session_start();

require 'connect.php';

if(isset($_POST['course']) && !empty($_POST['course']))
{
	$courseid = $_POST['course'];
	$_SESSION['course'] = $courseid;
	if($db->query("SELECT * FROM `Courses` WHERE `CourseID`='$courseid'")->rowCount() == 0)
		echo '<center>The course you entered does not exist.<br></center>';
	else
	{
		header('Location: view_attendance_summary2.php');
	}
}

include 'logout.php';

?>

<center>
	<h3>View Attendance</h3>
	<form method="POST" action="view_attendance_summary.php">
		Enter Course Id: <input type="text" name="course"><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<br><a href="view _attendance.php">Go Back</a>
</center>