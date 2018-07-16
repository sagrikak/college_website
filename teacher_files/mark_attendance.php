<?php
ob_start();
session_start();

require 'connect.php';

$teacher_id = $_SESSION['user_id'];
$teacher = $db->query("SELECT * FROM `Teachers` WHERE `username`='$teacher_id'")->fetchAll();
$course1 = $teacher[0]['course'];
$course2 = $teacher[0]['course1'];

if(isset($_POST['course']))
{
	if(!empty($_POST['course']))
	{
		$date = date("Y-m-d");
		$course = $_POST['course'];
		if($db->query("SELECT * FROM `Courses` WHERE `CourseID`='$course'")->rowCount()==0)
			echo '<center>The course you entered does not exist.<br></center>';
		else
		{
			if($db->query("SELECT * FROM $course WHERE `ClassDate` = '$date'")->rowCount()>=1)
				echo '<center>Date already exists.<br></center>';
			else
			{
				$_SESSION['course_id'] = $_POST['course'];
				$_SESSION['date'] = $date;
				header('Location: mark_attendance2.php');
			}
		}
	}
	else echo 'Please fill all the fields.<br>';
}

include 'logout.php';

?>

<center>
	<h3>Mark Attendance</h3>
	<form method="POST" action="mark_attendance.php">
		Course ID: <select name="course"> 
			<option value="<?php echo $course1 ?>"><?php echo $course1 ?></option>
			<?php if(!empty($course2)): ?>
				<option value="<?php echo $course2 ?>"><?php echo $course2 ?></option>
			<?php endif; ?>
		</select>
			<br><br>
		<input type="submit" name="submit" value="Go Ahead">
	</form>
	<br><a href="/Third Year Project/teacher.php">Go Back</a><br>
</center>



