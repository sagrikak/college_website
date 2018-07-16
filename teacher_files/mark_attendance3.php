<?php

ob_start();
session_start();

require 'connect.php';
include 'logout.php';

$course = $_SESSION['course_id'];
$date = $_SESSION['date'];

echo 'Attendance marked.<br>';

?>

<a href="mark_attendance.php"> Go Back </a>