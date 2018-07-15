<?php

ob_start();
session_start();

require 'connect.php';

$student_id = $_SESSION['user_id'];

$image_path = $db->query("SELECT `images_path` FROM `Images` WHERE `image_id` = '$student_id'")->fetchAll();
$details = $db->query("SELECT * FROM `Students` WHERE `username` = '$student_id'")->fetchAll();

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
	color: white;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(0, 0, 0, 0.6);">
	<div class="content" style = "font-family: Merienda;">
<center>
<h3> Your Profile </h3>
<table style="border-collapse: collapse; font: 20px Merienda; color: white;" cellspacing="5" cellpadding="50" border="0" cellspacing="50">
	<tbody>
		<tr>
			<td>
				Profile Picture:
			</td>
			<td>
				<img src="<?php echo $image_path[0][0] ?>" alt="Picture" height="250px" width="225px" />
			</td>
		</tr>
		<tr>
			<td>
				Name:
			</td>
			<td>
				<?php echo $details[0]['name'] ?>
			</td>
		</tr>
		<tr>
			<td>
				User ID:
			</td>
			<td>
				<?php echo $details[0]['username'] ?>
			</td>
		</tr>
		<tr>
			<td>
				Date Of Birth:
			</td>
			<td>
				<?php echo $details[0]['dob'] ?>
			</td>
		</tr>
		<tr>
			<td>
				Gender:
			</td>
			<td>
				<?php echo $details[0]['gender'] ?>
			</td>
		</tr>
		<tr>
			<td>
				Address:
			</td>
			<td>
				<?php echo $details[0]['address'] ?>
			</td>
		</tr>
		<tr>
			<td>
				Phone Number:
			</td>
			<td>
				<?php echo $details[0]['phone'] ?>
			</td>
		</tr>
		<tr>
			<td>
				Email ID:
			</td>
			<td>
				<?php echo $details[0]['email'] ?>
			</td>
		</tr>
		<tr>
			<td>
				Joining Year:
			</td>
			<td>
				<?php echo $details[0]['joining_year'] ?>
			</td>
		</tr>
		<tr>
			<td>
				Branch:
			</td>
			<td>
				<?php echo $details[0]['branch'] ?>
			</td>
		</tr>
	</tbody>
</table>

<br><br><a href="/Third Year Project/student.php">Go Back</a><br><br>
</center>
</div>
</div>