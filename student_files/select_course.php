<?php

ob_start();
session_start();

require 'connect.php';

$result = $db->query("SELECT * FROM `Courses`");
if($result->rowCount() == 0)
	echo 'Admin has not added courses yet.<br>';
else
{
	$courses = $result->fetchAll();
	echo '<h3>Select Courses</h3><br><form method="POST" action="select_course.php">';
	for($i=0; $i<$result->rowCount(); $i++)
	{
		$courseid = $courses[$i]['CourseID'];
		echo '<input type="checkbox" name="'.$courseid.'" value="'.$courses[$i]['CourseID'].'">  ';
		echo $courses[$i]['CourseID'].' : '.$courses[$i]['CourseName'].'<br><br>';
	}
	echo '<button>Submit</button><br>';

	for($i=0; $i<$result->rowCount(); $i++)
	{
		$courseid = $courses[$i]['CourseID'];
		if(isset($_POST[$courseid]))
		{
			$student_id = $_SESSION['user_id'];
			if($db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`='$courseid' && `StudentID`='$student_id'")->rowCount() == 0)
			{
				$db->query("INSERT INTO `Course_Takers` VALUES ('$courseid', '$student_id')");
				$db->query("ALTER TABLE `$courseid` ADD `$student_id` char(1) NULL AFTER `ClassDate`");
				echo 'Course Added.<br>';
			}
			else echo 'Course is already added.<br>';
		}
	}
}

include 'logout.php';

?>

<br><a href="/Third Year Project/student.php">Go Back</a>