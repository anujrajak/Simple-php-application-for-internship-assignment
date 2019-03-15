<?php
require 'config.php';

$conn = connection();

$subject = $_REQUEST['subject'];
$course = $_REQUEST['course'];

$check = mysqli_query($conn, "SELECT * FROM `course-subject` WHERE cs_cid = $course AND cs_sid = $subject");

if (mysqli_num_rows($check) == 0) {
	if (mysqli_query($conn, "INSERT INTO `course-subject` (`cs_id`, `cs_cid`, `cs_sid`) VALUES (NULL, '$course', '$subject')")) {
		echo "<p class='text-success'>Subject assigned to course...<p>";
	}else{
		echo "<p class='text-danger'>Error occured...<p>";
	}
}else{
	echo "<p class='text-danger'>Subject already assigned...</p>";
}