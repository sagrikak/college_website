<?php
ob_start();
session_start();

require 'connect.php';

$studentid = $_SESSION['user_id'];
$courses = $db->query("SELECT * FROM `Course_Takers` WHERE `StudentID` = '$studentid'")->fetchAll();

if(isset($_POST['course']) && !empty($_POST['course']))
{
	$courseid = $_POST['course'];
	if($db->query("SELECT * FROM `Courses` WHERE `CourseID`='$courseid'")->rowCount() == 0)
		echo '<center>The course you entered does not exist.<br></center>';
	else
	{
		if($db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`='$courseid' && `StudentID`='$studentid'")->rowCount() == 0)
			echo '<center>You didn\'t opt for this course.<br></center>';
		else
		{
			$_SESSION['course_id'] = $courseid;
			header('Location: view_attendance2.php');
		}
	}
}

include 'logout.php';

?>

<center>
	<h3>View Attendance</h3>
	<form method="POST" action="view_attendance.php">
		Enter Course Id: 
		<select name = "course">
			<?php foreach ($courses as $course): ?>
				<option value="<?php echo $course['CourseID']?>"><?php echo $course['CourseID']?></option>
			<?php endforeach; ?>
		</select><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<br><a href="/Third Year Project/student.php">Go Back</a>
</center>