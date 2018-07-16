<?php
ob_start();
session_start();

require 'connect.php';
include 'logout.php';

$courseid = $_SESSION['course'];
if($db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`='$courseid'")->rowCount()==0)
	echo 'No student has opted for this course.<br>';
else if($db->query("SELECT * FROM $courseid")->rowCount()==0)
	echo 'No classes for this course have taken place yet.<br>';
else
{
	$students=$db->query("SELECT `StudentID` FROM `Course_Takers` WHERE `CourseID`='$courseid'");
	$total = $db->query("SELECT * FROM $courseid")->rowCount();
	//$total/=2;
	echo '<center>Course ID: '.$courseid.'</center>';
	echo '<h3>Attendance Record</h3>';
	echo '<pre><strong>Student ID    Total    Attended    Leave    Percentage</strong></pre>';
	foreach($students as $student)
	{
		$studentid=$student[0];
		$attended = $db->query("SELECT * FROM $courseid WHERE $studentid = 'P'")->rowCount();
		$leave = $db->query("SELECT * FROM $courseid WHERE $studentid = 'L'")->rowCount();
		//$attended/=2;
		//$leave/=2;
		$percent = $attended*100/$total;
		echo '<pre>'.$studentid.'         '.$total.'          '.$attended.'         '.$leave.'          '.$percent.'%</pre>'; 
	}
}

?>

<br><a href="view_attendance_summary.php">Go Back</a>
