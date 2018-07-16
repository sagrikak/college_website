<?php

ob_start();
session_start();

require 'connect.php';

$course = $_SESSION['course_id'];
$date = $_SESSION['date'];

if($db->query("SELECT * FROM `Courses` WHERE `CourseID` = '$course'")->rowCount() == 1)
{
	{
		$db->query("INSERT INTO $course (`ClassDate`) VALUES ('$date')");
		$result = $db->query("SELECT `StudentID` FROM `Course_Takers` WHERE `CourseID`='$course'");
		if($result->rowCount()==0)
			echo 'No student has opted for this course.<br>';
		else
		{
			$students = $result->fetchAll();

			for($i=0; $i<$result->rowCount(); $i++)
			{
				$course = $_SESSION['course_id'];
				$studentid = $students[$i]['StudentID'];
				if(isset($_POST['submit']))
				{
					if(isset($_POST[$studentid]))
					{
						$db->query("UPDATE $course SET `$studentid` = 'P' WHERE `ClassDate`= '$date'");
					}
					else
					{
						$db->query("UPDATE $course SET `$studentid` = 'A' WHERE `ClassDate`= '$date'");
					}
				}
			}

			echo '<h3>Mark Attendance</h3>Mark the students that are present.<br><br><form method="POST" action="mark_attendance2.php">';
			for($i=0; $i<$result->rowCount(); $i++)
			{
				$studentid = $students[$i]['StudentID'];
				echo '<input type="checkbox" name="'.$studentid.'" value="'.$studentid.'">  ';
				echo $studentid.'<br><br>';
			}
			echo '<button name="submit">Submit</button><br>';

			for($i=0; $i<$result->rowCount(); $i++)
			{
				$course = $_SESSION['course_id'];
				$studentid = $students[$i]['StudentID'];
				if(isset($_POST['submit']))
				{
					if(isset($_POST[$studentid]))
					{
						$db->query("UPDATE $course SET `$studentid` = 'P' WHERE `ClassDate`= '$date'");
					}
					else
					{
						$db->query("UPDATE $course SET `$studentid` = 'A' WHERE `ClassDate`= '$date'");
					}
					$message ="Attendance marked!";
					if($i=$result->rowCount()-1)
						echo "<script type='text/javascript'>alert('$message'); window.location = 'mark_attendance.php'; </script>";

				}
			}
		}
	}
}
else echo 'The course you entered does not exist.<br>';

include 'logout.php';

?>

<br><br><a href="/Third Year Project/teacher.php">Go Back</a><br><br>