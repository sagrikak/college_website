<?php

ob_start();
session_start();

require_once 'vendor/autoload.php';
require 'connect.php';

$teacher_id = $_SESSION['user_id'];
$teacher = $db->query("SELECT * FROM `Teachers` WHERE `username`='$teacher_id'")->fetchAll();
$course1 = $teacher[0]['course'];
$course2 = $teacher[0]['course1'];

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
	$courseid = $_POST['course'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        $errors= array();
        $file_name = "mail".$_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=GetImageExtension($file_type);
      
        if($file_size > 2097152) {
           $errors[]='File size must be below 2 MB';
        }
      
        if(empty($errors)==true) {
           move_uploaded_file($file_tmp,"mail/".$file_name); //The folder where you would like your file to be saved
           echo "Success";
        }else{
           print_r($errors);
        }
    }

	if($db->query("SELECT * FROM `Courses` WHERE `CourseID`='$courseid'")->rowCount() == 0)
		echo '<center>The course you entered does not exist.<br></center>';
	else
	{
		if($db->query("SELECT * FROM `Course_Takers` WHERE `CourseID`='$courseid'")->rowCount()==0)
			echo '<center>No one has opted for this course.</center>';
		else
		{
			$sender_email = $db->query("SELECT `email` FROM `Teachers` WHERE `username` = '$teacher_id'")->fetchAll();
			$sender_name = $db->query("SELECT `name` FROM `Teachers` WHERE `username` = '$teacher_id'")->fetchAll();

			$result = $db->query("SELECT `StudentID` FROM `Course_Takers` WHERE `CourseID`='$courseid'");

			$students = $result->fetchAll();

			$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			
			$mail->Host = gethostbyname('smtp.gmail.com');
			$mail->IsSMTP();

			$mail->SMTPAuth = true;

			$mail->Username = "sagrikagemini@gmail.com";
			$mail->Password = "up85ae8251";

			$mail->SMTPAutoTLS = false;

			$mail->SMTPSecure = 'ssl';
			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
			$mail->Port = 465;

			$mail->From = "localhost@biet.com";
			$mail->FromName = $sender_name[0]['name'];

			for($i=0; $i<$result->rowCount(); $i++)
			{
				$studentid = $students[$i]['StudentID'];
				$receipient_email = $db->query("SELECT `email` FROM `Students` WHERE `username` = '$studentid'")->fetchAll();
				$mail->addAddress($receipient_email[0]['email']);
			}
			$mail->addReplyTo($sender_email[0]['email']);
				$mail->isHTML(true);
			if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name']))
				$mail->addAttachment("mail/".$file_name);
			$mail->Subject = $subject;
			$mail->Body = $message;
			$mail->AltBody = $message;
			if(!$mail->Send())
			{
				echo "Message could not be sent. <p>";
				echo "Mailer Error: " . $mail->ErrorInfo;
				exit;
			}else
				echo "<script>alert('Message has been sent')</script>";
		}
	}
}

include 'logout.php';

?>

<form action='send_email.php' enctype="multipart/form-data" method='post'>
<fieldset>
<legend>Send Email</legend>

<div class='container'>
  
    <label for='course' >Course ID*:</label><br/>
    <select name="course"> 
			<option value="<?php echo $course1 ?>"><?php echo $course1 ?></option>
			<?php if(!empty($course2)): ?>
				<option value="<?php echo $course2 ?>"><?php echo $course2 ?></option>
			<?php endif; ?>
		</select><br>
    <label for='Subject' >Subject*:</label><br/>
    <input type="text" id="subject" name="subject" required /><br>
 
    <label for='message' >Message:</label><br/>
    <textarea rows="10" cols="50" name='message' id='message'></textarea>
    <br>
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input id="file" name="image" type="file" /><br><br>
    <input type='submit' name='submit' value='Send' />
</div>

</fieldset>
</form>
<br><br><a href="/Third Year Project/teacher.php">Go Back</a><br><br>