<?php

ob_start();
session_start();

require 'connect.php';

if(isset($_POST['username']) && isset($_POST['password']))
{
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
		//echo $_POST['username'].'<br>';
		//echo $_POST['password'];
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$result = $db->query("SELECT * FROM `Users` WHERE `username` = '$user' && `password` = '$pass'");
		$row = $result->fetchAll();
		$user_type = $row['0']['type'];
		$user_flag = $row['0']['flag'];
		if($result->rowCount() == 1)
		{
			if($user_type=='T')
			{
				$_SESSION['user_id'] = $user;
				if($user_flag == 0)
					header('Location: teacher_files/teacher_fill_profile.php');
				else {
					header('Location: teacher.php');
				}
			}
			else if($user_type=='S')
			{
				$_SESSION['user_id'] = $user;
				if($user_flag == 0)
					header('Location: student_files/student_fill_profile.php');
				else {
					header('Location: student.php');
				}
			}
			else if($user_type=='A')
			{
				$_SESSION['user_id'] = $user;
				header('Location: admin.php');
			}
		}
		else
		{
			$message = "Username and/or Password incorrect.\\nTry again.";
  			echo "<script type='text/javascript'>alert('$message'); window.location = 'home_page.php'; </script>";
		}
	}
	else echo 'Please enter both username and password.<br>';
}

?>