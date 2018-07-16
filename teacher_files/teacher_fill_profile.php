<?php

ini_set('display_errors',1); error_reporting(E_ALL);
ob_start();
session_start();

require 'connect.php';

$teacher_id = $_SESSION['user_id'];
$courses = $db->query("SELECT * FROM `Courses`")->fetchAll();

function GetImageExtension($imagetype)
{
   if(empty($imagetype)) return false;
    switch($imagetype)
    {
    	case 'image/bmp': return '.bmp';
        case 'image/gif': return '.gif';
        case 'image/jpeg': return '.jpg';
        case 'image/png': return '.png';
        default: return false;
	}
}

if(isset($_POST['submit'])) 
{
	if(!empty($_POST['tname']) && !empty($_POST['dob']) && !empty($_POST['gender']) && !empty($_POST['address']) && !empty($_POST['number']) && !empty($_POST['email']) && !empty($_FILES["uploadedimage"]["name"]) && !empty($_POST['course']))
	{
	
		$file_name=$_FILES["uploadedimage"]["name"];
		$temp_name=$_FILES["uploadedimage"]["tmp_name"];
	    $imgtype=$_FILES["uploadedimage"]["type"];
	    $ext= GetImageExtension($imgtype);
	    $imagename=$teacher_id.$ext;
	    $target_path = "images/".$imagename;
		if(move_uploaded_file($temp_name, $target_path)) {
		    $query_upload="INSERT INTO `Images` VALUES ('$teacher_id', '$target_path')";
		    $db->query($query_upload);
		}else
			echo("Error While uploading image on the server");
		

		$name = $_POST['tname'];
		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$phone = $_POST['number'];
		$email = $_POST['email'];
		$course = $_POST['course'];
		$course2 = $_POST['course2'];
		$db->query("INSERT INTO Teachers VALUES ('$teacher_id', '$name', '$dob', '$gender', '$address', '$phone', '$email', '$course', '$course2')");

		$db->query("UPDATE Users SET flag = 1 WHERE username = '$teacher_id'");
		echo '<center>Details Successfully Updated.<br></center>';

		header('Location: /Third Year Project/teacher_files/teacher_view_profile.php');
	}
	else echo 'Please fill all the fields.<br>';
}

include 'logout.php';

?>

<center>
	<h3>Create Profile</h3>
	<form method="POST" action="teacher_fill_profile.php" enctype="multipart/form-data">

		<table style="border-collapse: collapse; font: 16px Tahoma;margin-left: 40px" border="0" cellspacing="5" cellpadding="5" >
		<tbody>
			<tr>
				<td> Profile Picture:</td>
				<td>
				<center><input name="uploadedimage" type="file"></center>
				</td>
			</tr>
		</tbody>
		</table><br>

		Name: <input type="text" name="tname"><br><br>
		Date Of Birth: <input type="date" name="dob" value="yyyy-mm-dd" max="<?php echo date("Y-m-d")?>"><br><br>
		Gender: <input type="radio" name="gender" value="Male">Male<input type="radio" name="gender" value="Female">Female<br><br>
		Address: <input type="text" name="address"><br><br>
		Phone Number: <input type="number" name="number" maxlength="10" minlength="10"><br><br>
		Email ID: <input type="email" name="email"><br><br>
		Course ID: <select name = "course">
			<?php foreach ($courses as $course): ?>
				<option value="<?php echo $course['CourseID']?>"><?php echo $course['CourseID']?></option>
			<?php endforeach; ?>
		</select><br><br>
		Course ID: <select name = "course2">
			<?php foreach ($courses as $course): ?>
				<option value="<?php echo $course['CourseID']?>"><?php echo $course['CourseID']?></option>
			<?php endforeach; ?>
			<option value=NULL>--</option>
		</select><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
</center>