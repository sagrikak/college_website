<?php

ob_start();
session_start();

require 'connect.php';
include 'logout.php';

$studentid = $_SESSION['user_id'];
$courseid = $_SESSION['course_id'];

echo "<center><b>".$courseid." Attendance</b></center><br>";

$total = $db->query("SELECT * FROM $courseid")->rowCount();
$attended = $db->query("SELECT * FROM $courseid WHERE `$studentid` = 'P' OR `$studentid` = 'L'")->rowCount();
if($total>0)
{
	$percent = $attended*100/$total;
	echo '<center>';
	echo 'Total: '.$total.'<br>';
	echo 'Attended: '.$attended.'<br>';
	echo 'Percentage: '.$percent.'<br>';
	echo '</center><br><br>';
}
else echo '<center>No classes for this course have taken place.</center><br>';

$attendance = $db->query("SELECT * FROM `$courseid`")->fetchAll();

for($i=0; $i<$total; $i++)
{
	echo "<center>".$attendance[$i]['ClassDate']."&nbsp&nbsp&nbsp&nbsp".$attendance[$i][$studentid]."</center><br>";
}

?>
<center>
<br><br><a href="/Third Year Project/student_files/view_attendance.php">Go Back</a><br></center>
