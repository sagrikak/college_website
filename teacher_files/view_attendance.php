<?php
ob_start();
session_start();

require 'connect.php';

$teacherid = $_SESSION['user_id'];
$teacher = $db->query("SELECT * FROM `Teachers` WHERE `username`='$teacherid'")->fetchAll();
$course1 = $teacher[0]['course'];
$course2 = $teacher[0]['course1'];

if(isset($_POST['course']) && !empty($_POST['course']))
{
	$courseid = $_POST['course'];
	if($db->query("SELECT * FROM `Courses` WHERE `CourseID`='$courseid'")->rowCount() == 0)
		echo '<center>The course you entered does not exist.<br></center>';
	else
	{
		if($db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`='$courseid'")->rowCount() == 0)
			echo '<center>No one has opted for this course.<br></center>';
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
		Course Id: <select name="course"> 
			<option value="<?php echo $course1 ?>"><?php echo $course1 ?></option>
			<?php if(!empty($course2)): ?>
				<option value="<?php echo $course2 ?>"><?php echo $course2 ?></option>
			<?php endif; ?>
		</select><br><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<br><a href="/Third Year Project/teacher.php">Go Back</a>
</center>