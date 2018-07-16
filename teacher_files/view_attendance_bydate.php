<?php
ob_start();
session_start();

require 'connect.php';

if(isset($_POST['course']) && !empty($_POST['course']) && isset($_POST['date']) && !empty($_POST['date']))
{
	$courseid = $_POST['course'];
	$_SESSION['course'] = $courseid;
	$date = $_POST['date'];
	$_SESSION['date'] = $date;
	if($db->query("SELECT * FROM $courseid WHERE `ClassDate`='$date'")->rowCount()==0)
		echo '<center>No class for this subject took place on the given date.</center>';
	else header('Location: view_attendance_bydate2.php');
}

include 'logout.php';

?>

<center>
	<h3>View Attendance</h3>
	<form method="POST" action="view_attendance_bydate.php">
		Enter Course Id: <input type="text" name="course"><br><br>
		Enter Date: <input type="date" name="date" value="yyyy-mm-dd" max="<?php echo date("Y-m-d")?>"><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<br><a href="view _attendance.php">Go Back</a>
</center>

