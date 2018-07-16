<?php

ob_start();
session_start();

require 'connect.php';

$teacher_id = $_SESSION['user_id'];
$courses = $db->query("SELECT * FROM `Courses`")->fetchAll();

$image_path = $db->query("SELECT `images_path` FROM `Images` WHERE `image_id` = '$teacher_id'")->fetchAll();
$details = $db->query("SELECT * FROM `Teachers` WHERE `username` = '$teacher_id'")->fetchAll();

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
	if(!empty($_POST['tname']) && !empty($_POST['dob']) && !empty($_POST['gender']) && !empty($_POST['address']) && !empty($_POST['number']) && !empty($_POST['email']))
	{

		$db->query("DELETE FROM `Teachers` WHERE `username`='$teacher_id'");
	
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

		$db->query("UPDATE `Users` SET `flag` = 1 WHERE `username` = '$teacher_id'");
		echo '<center>Details Successfully Updated.<br></center>';

		header('Location: /Third Year Project/teacher_files/teacher_view_profile.php');
	}
	else echo 'Please fill all the fields.<br>';
}

include 'logout.php';

?>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="home.css">
<link href="https://fonts.googleapis.com/css?family=Acme|Allura|Amatic+SC|Berkshire+Swash|Julius+Sans+One|Kaushan+Script|Merienda|Norican" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cinzel|Cookie|Dancing+Script|Lato|Patrick+Hand+SC|Rancho|Rock+Salt" rel="stylesheet">

<div class="container" style="background-color: #333;
	color: gray;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(0, 0, 0, 0.6);">
	<div class="content" style = "font-family: Merienda;">

<center>
	<h3 style="color:white">Edit Profile</h3>
	<form method="POST" action="teacher_edit_profile.php" enctype="multipart/form-data">

		<table style="border-collapse: collapse; font: 20px Merienda; color:gray;margin-left: 40px" border="0" cellspacing="5" cellpadding="5" >
		<tbody>
			<tr>
				<td> <p>Profile Picture:&nbsp&nbsp&nbsp</p></td>
				<td>
					<img src="<?php echo $image_path[0][0] ?>" alt="Picture" height="150px" width="125px" />
				</td>
				<td>
					<center><input name="uploadedimage" type="file"></center>
				</td>
			</tr>
		</tbody>
		</table><br>

		Name: <input type="text" name="tname" value="<?php echo $details[0]['name'] ?>"><br><br>
		Date Of Birth: <input type="date" name="dob" value="<?php echo $details[0]['dob'] ?>" max="<?php echo date("Y-m-d")?>"><br><br>
		Gender: <input type="radio" name="gender" value="Male">Male<input type="radio" name="gender" value="Female">Female<br><br>
		Address: <input type="text" name="address" value="<?php echo $details[0]['address'] ?>"><br><br>
		Phone Number: <input type="number" name="number" value="<?php echo $details[0]['phone'] ?>" maxlength="10" minlength="10"><br><br>
		Email ID: <input type="email" name="email" value="<?php echo $details[0]['email'] ?>"><br><br>
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
		</select><br><br><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>

	<br><br><a href="/Third Year Project/teacher.php">Go Back</a><br><br>
</center>
</div>
</div>