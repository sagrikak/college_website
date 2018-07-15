<?php

ob_start();
session_start();

require 'connect.php';

$student_id = $_SESSION['user_id'];

$image_path = $db->query("SELECT `images_path` FROM `Images` WHERE `image_id` = '$student_id'")->fetchAll();
$details = $db->query("SELECT * FROM `Students` WHERE `username` = '$student_id'")->fetchAll();

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
	if(!empty($_POST['sname']) && !empty($_POST['dob']) && !empty($_POST['gender']) && !empty($_POST['address']) && !empty($_POST['number']) && !empty($_POST['email']) && !empty($_POST['jyear']) && !empty($_POST['branch']))
	{

		$db->query("DELETE FROM `Students` WHERE `username`='$student_id'");
	
		$file_name=$_FILES["uploadedimage2"]["name"];
		$temp_name=$_FILES["uploadedimage2"]["tmp_name"];
	    $imgtype=$_FILES["uploadedimage2"]["type"];
	    $ext= GetImageExtension($imgtype);
	    $imagename=$student_id.$ext;
	    $target_path = "images/".$imagename;
		if(move_uploaded_file($temp_name, $target_path)) {
		    $query_upload="INSERT INTO `Images` VALUES ('$student_id', '$target_path')";
		    $db->query($query_upload);
		}else
			echo("Error While uploading image on the server");
		

		$name = $_POST['sname'];
		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$phone = $_POST['number'];
		$email = $_POST['email'];
		$jyear = $_POST['jyear'];
		$branch = $_POST['branch'];		

		$db->query("INSERT INTO `Students` VALUES ('$student_id', '$name', '$dob', '$gender', '$address', '$phone', '$email', '$jyear', '$branch')");

		$db->query("UPDATE Users SET flag = 1 WHERE username = '$student_id'");
		echo '<center>Details Successfully Updated.<br></center>';

		header('Location: /Third Year Project/student_files/student_view_profile.php');
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
	<form method="POST" action="student_edit_profile.php" enctype="multipart/form-data">

		<table style="border-collapse: collapse; color: gray; font: 16px Merienda;margin-left: 40px" border="0" cellspacing="5" cellpadding="5" >
		<tbody>
			<tr>
				<td> <p>Profile Picture:&nbsp&nbsp&nbsp</p></td>
				<td>
					<img src="<?php echo $image_path[0][0] ?>" alt="Picture" height="250px" width="225px" /> 
				</td>
				<td>
					<center><input name="uploadedimage2" type="file"></center>
				</td>
			</tr>
			</tr>
		</tbody>
		</table><br>

		Name: <input type="text" name="sname" value="<?php echo $details[0]['name'] ?>"><br><br>
		Date Of Birth: <input type="date" name="dob" max="<?php echo date("Y-m-d")?>" value="<?php echo $details[0]['dob'] ?>"><br><br>
		Gender: <input type="radio" name="gender" value="Male">Male<input type="radio" name="gender" value="Female">Female<br><br>
		Address: <input type="text" name="address" value="<?php echo $details[0]['address'] ?>"><br><br>
		Phone Number: <input type="number" name="number" maxlength="10" minlength="10" value="<?php echo $details[0]['phone'] ?>"><br><br>
		Email ID: <input type="email" name="email" value="<?php echo $details[0]['email'] ?>"><br><br>
		Joining Year: <input type="year" name="jyear" value="<?php echo $details[0]['joining_year'] ?>"><br><br>
		Branch: 
		 <select name="branch">
		  <option value="EC">EC</option>
		  <option value="IT">IT</option>
		  <option value="CSE">CSE</option>
		  <option value="EE">EE</option>
		  <option value="CH">CH</option>
		  <option value="CE">CE</option>
		  <option value="ME">ME</option>
		</select> <br><br>
		
		<input type="submit" name="submit" value="Submit">
	</form>
	<br><br><a href="/Third Year Project/student.php">Go Back</a><br><br>
</center>
</div>
</div>