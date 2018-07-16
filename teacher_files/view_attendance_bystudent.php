<?php
ob_start();
session_start();

require 'connect.php';

if(isset($_POST['course']) && !empty($_POST['course']) && isset($_POST['student']) && !empty($_POST['student']))
{
	$courseid = $_POST['course'];
	$_SESSION['course'] = $courseid;
	$studentid = $_POST['student'];
	$_SESSION['student'] = $studentid;
	if($db->query("SELECT * FROM `Courses` WHERE `CourseID`='$courseid'")->rowCount() == 0)
		echo '<center>The course you entered does not exist.<br></center>';
	else if($db->query("SELECT * FROM `Users` WHERE `username`='$studentid' AND `type`='S'")->rowCount() == 0)
		echo '<center>The Student Id you entered does not belong to any student.</center>';
	else if($db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`='$courseid' AND `StudentID`='$studentid'")->rowCount()==0)
		echo '<center>The Student Id you entered does not belong to this course.</center>';
	else
	{
		header('Location: view_attendance_bystudent2.php');
	}
}

include 'logout.php';

?>

<center>
	<h3>View Attendance</h3>
	<form method="POST" action="view_attendance_bystudent.php">
		Enter Course Id: <input type="text" name="course"><br><br>
		Enter Student Id: <input type="text" name="student"><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<br><a href="view _attendance.php">Go Back</a>
</center>