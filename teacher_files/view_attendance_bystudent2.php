<?php	
ob_start();
session_start();

require 'connect.php';
include 'logout.php';

$studentid = $_SESSION['student'];
$courseid = $_SESSION['course'];

if($db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`= '$courseid' && `StudentID`='$studentid'")->rowCount() == 0)
	echo '<center>This student is not registered for this course.<br></center>';
else
{
	$total = $db->query("SELECT * FROM $courseid")->rowCount();
	$attended = $db->query("SELECT * FROM $courseid WHERE $studentid = 'P'")->rowCount();
	$leave = $db->query("SELECT * FROM $courseid WHERE $studentid = 'L'")->rowCount();
	if($total>0)
	{
		/*$total/=2;
		$attended/=2;
		$leave/=2;*/
		$percent = $attended*100/$total;
		echo '<center>';
		echo 'Course ID: '.$courseid.'<br>Student ID: '.$studentid.'<br><br>';
		echo 'Total: '.$total.'<br>';
		echo 'Attended: '.$attended.'<br>';
		echo 'Leave: '.$leave.'<br>';
		echo 'Percentage: '.$percent.'<br>';
		echo '</center>';
		$result = $db->query("SELECT `ClassDate`, $studentid FROM $courseid");
		echo '<br><h3>ATTENDANCE RECORD</h3>';
		echo '<pre><strong>S.No.    Date    Attendance</strong></pre>';
		$count=1;
		foreach ($result as $date) {
			//if($count%2 == 0)
			{
				$k=$count;
				echo '<pre>'.$k.'     '.$date[0].'     '.$date[1].'</pre>';
			}
			$count++;
		}
	}
	else echo '<center>No classes for this course have taken place.</center><br>';
}

?>

<br><a href="view_attendance_bystudent.php">Go Back</a>