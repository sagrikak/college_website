<?php

ob_start();
session_start();

require 'connect.php';
include 'logout.php';

$teacherid = $_SESSION['user_id'];
$courseid = $_SESSION['course_id'];

$students = $db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`='$courseid'")->rowCount();
if($students>0)
{
	$students_list = $db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`='$courseid'")->fetchAll();
	$total = $db->query("SELECT * FROM $courseid")->rowCount();
	if($total>0)
	{
		$attendance = $db->query("SELECT * FROM `$courseid`")->fetchAll();

		echo "<center><b>Class Date&nbsp&nbsp&nbsp&nbsp";
		for($j=0; $j<$students; $j++)
		{
			$studentid = $students_list[$j]['StudentID'];
			echo $studentid."&nbsp&nbsp&nbsp&nbsp";
		}
		echo "</b><br><br>";

		for($i=0; $i<$total; $i++)
		{
			echo "<center>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$attendance[$i]['ClassDate']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
			for($j=0; $j<$students; $j++)
			{
				$studentid = $students_list[$j]['StudentID'];
				$attended = $db->query("SELECT * FROM $courseid WHERE `$studentid` = 'P'")->rowCount();
				echo $attendance[$i][$studentid]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
			}
			echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</center><br>";
		}

		echo "<center>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Percentage</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
		for($j=0; $j<$students; $j++)
		{
			$studentid = $students_list[$j]['StudentID'];
			$attended = $db->query("SELECT * FROM $courseid WHERE `$studentid` = 'P' OR `$studentid` = 'L'")->rowCount();
			$percent = $attended*100/$total;
			echo $percent."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
		}
		echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</center><br>";

	}
	else echo "<center>No classes have taken place for this course.<br></center>";
}
else echo "<center>No students have opted for this course.<br></center>";

?>
<center>
<br><br><a href="/Third Year Project/teacher_files/view_attendance.php">Go Back</a><br></center>
