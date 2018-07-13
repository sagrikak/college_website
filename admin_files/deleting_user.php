<?php
ob_start();
session_start();

require 'connect.php';

if(isset($_POST['username']))
{
	if(!empty($_POST['username']))
	{
		$user = $_POST['username'];
		if($db->query("SELECT * FROM `Users` WHERE `username`='$user'")->rowCount() == 0)
			echo '<center>Sorry. User not found.</center><br>';
		else
		{
			$db->query("DELETE FROM `Users` WHERE `username` = '$user'");
			$db->query("DELETE FROM `Course_Takers` WHERE `StudentID` = '$user'");
			$db->query("DELETE FROM `Students` WHERE `username` = '$user'");
			$db->query("DELETE FROM `Teachers` WHERE `username` = '$user'");
			echo "<script type='text/javascript'>alert('User deleted.'); </script>";
		}
	}
	else echo '<center>Please enter a username.<br></center>';
}

include 'logout.php';

?>

<center>
	<h3>Delete a user.</h3>
	<form method="POST" action="deleting_user.php">
		Username: <input type="text" name="username"><br><br>
		<button>Submit</button>
	</form>
	<br><a href="/Third Year Project/admin.php">Go Back</a><br>
</center>