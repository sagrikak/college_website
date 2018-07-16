<?php

ob_start();
session_start();

require 'connect.php';
include 'logout.php';

$date = $_SESSION['date'];
$courseid = $_SESSION['course'];

if($db->query("SELECT `StudentID` FROM `Course_Takers` WHERE `CourseID`='$courseid'")->rowCount()==0)
	echo 'No student has opted for this course.<br>';

$students = $db->query("SELECT `StudentID` FROM `Course_Takers` WHERE `CourseID`='$courseid'");
echo '<center>Course ID: '.$courseid.'<br>';
echo 'Date: '.$date.'<br></center>';
echo '<h3>Attendance Record</h3>';
echo '<pre><strong>Student ID      Attendance</strong></pre>';
foreach($students as $student)
{
	$username = $student[0];
	$values = $db->query("SELECT `$username` FROM `$courseid` WHERE `ClassDate`='$date'");
	foreach($values as $value)
		$attendance = $value[0];
	echo '<pre>'.$username.'           '.$attendance.'</pre>';
}

?>

<br><a href="view_attendance_bydate.php">Go Back</a>