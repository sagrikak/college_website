<?php
ob_start();
session_start();

require 'connect.php';

$teacher_id = $_SESSION['user_id'];
$teacher = $db->query("SELECT * FROM `Teachers` WHERE `username`='$teacher_id'")->fetchAll();
$course1 = $teacher[0]['course'];
$course2 = $teacher[0]['course1'];

if(isset($_POST['course']) && isset($_POST['date']))
{
	if(!empty($_POST['course']) && !empty($_POST['date']) && !empty($_POST['student']))
	{
		$date = $_POST['date'];
		$courseid = $_POST['course'];
		$studentid = $_POST['student'];
		if($db->query("SELECT * FROM `Courses` WHERE `CourseID`='$courseid'")->rowCount()==0)
			echo '<center>The course you entered does not exist.<br></center>';
		else
		{
			if($db->query("SELECT * FROM `Course_Takers` WHERE `StudentID`='$studentid' AND `CourseID`='$courseid'")->rowCount() == 0)
				echo "<center>This student hasn't opted for this course.</center><br>";
			else
			{
				if($db->query("SELECT * FROM $courseid WHERE `ClassDate` = '$date'")->rowCount()==0)
					echo "<center>No class took place on given date.</center><br>";
				else 
				{
					$db->query("UPDATE $courseid SET `$studentid` = 'L' WHERE `ClassDate` = '$date'");
					$message = "Leave Marked";
					echo "<script type='text/javascript'>alert('$message'); </script>";

				}
			}
		}
	}
	else echo 'Please fill all the fields.<br>';
}

include 'logout.php';

?>

<center>
	<h3>Mark Leave</h3>
	<form method="POST" action="mark_leave.php">
		Course ID: <select name="course"> 
			<option value="<?php echo $course1 ?>"><?php echo $course1 ?></option>
			<?php if(!empty($course2)): ?>
				<option value="<?php echo $course2 ?>"><?php echo $course2 ?></option>
			<?php endif; ?>
		</select><br><br>
		Student ID: <input type="text" name="student"><br><br>
		Date: <input type="date" name="date" value="yyyy-mm-dd" max="<?php echo date("Y-m-d")?>"><br><br>
		<button>Mark Leave</button>
	</form>
	<br><a href="/Third Year Project/teacher.php">Go Back</a><br>
</center>



