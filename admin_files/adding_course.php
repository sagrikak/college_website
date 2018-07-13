<?php
ob_start();
session_start();

require 'connect.php';

if(isset($_POST['course_id']) && isset($_POST['course_name']))
{
	if(!empty($_POST['course_id']) && !empty($_POST['course_name']))
	{
		$id = $_POST['course_id'];
		$name = $_POST['course_name'];

		if($db->query("SELECT * FROM `Courses` WHERE `CourseID`='$id'")->rowCount()>=1)
			echo '<center>Course already added.<br>Try again.</center><br>';
		else 
		{
			$db->query("INSERT INTO `Courses` VALUES ('$id', '$name')");
			$db->query("CREATE TABLE $id (ClassDate Date PRIMARY KEY)");
			echo "<script type='text/javascript'>alert('Course successfully added.'); </script>";

		}
	}
	else echo 'Please fill in all the fields.<br>';
}

include 'logout.php';

?>

<center>
	<h3>Add a new course</h3>
	<form method="post" action="adding_course.php">
		Course ID: <input type="text" name="course_id"><br><br>
		Course Name: <input type="text" name="course_name"><br><br>
		<button>Submit</button>
	</form>
	<br><a href="/Third Year Project/admin.php">Go Back</a><br>
</center>