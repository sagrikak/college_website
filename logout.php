<?php

if(isset($_POST['logout']))
{
	session_destroy();
	header('Location: /Third Year Project/home_page.php');
}

?>
<br>
<div align="right">
	<form action="<?php echo $cur_file; ?>" method="POST">
		<input type="submit" value="Log Out" name="logout">
	</form>
</div>
