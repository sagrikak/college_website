<?php
ob_start();
session_start();

require 'connect.php';

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type']))
{
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
		$flag=0;
		$user = $_POST['username'];
		$pass = $_POST['password'];
		if($_POST['type'] == 'admin')
		{
			$type="A";
			$flag=1;
		}
		else if($_POST['type'] == 'student')
			$type="S";
		else $type="T";
		if($db->query("SELECT * FROM `Users` WHERE `username`='$user'")->rowCount()>=1)
			echo '<center>User already registered.<br>Try again.</center><br>';
		else 
		{
			$db->query("INSERT INTO `Users` VALUES ('$user', '$pass', '$type', '$flag')");
			echo "<script type='text/javascript'>alert('User successfully registered.'); </script>";
		}
	}
	else echo 'Please fill in all the fields.<br>';
}

include 'logout.php';

?>
<center>
	<h3>Add a new User</h3>
	<form method="post" action="adding_user.php">
		Username: <input type="text" name="username"><br><br>
		Password: <input type="password" name="password" minlength="6" maxlength="12"><br><br>
		Select User Type: <br>
		<input type="radio" name="type" value="admin"> Admin<br>
		<input type="radio" name="type" value="student" checked> Student<br>
		<input type="radio" name="type" value="teacher"> Teacher<br><br>
		<button>Submit</button>
	</form>
	<br><a href="/Third Year Project/admin.php">Go Back</a><br>
</center>	

