<?php
require 'config.php';

$conn = connection();

$stu_id = $_REQUEST['student'];
$cou_id = $_REQUEST['course'];

$check = mysqli_query($conn, "SELECT stu_course FROM student WHERE stu_id = $stu_id");
foreach ($check as $row) {}

if ($row['stu_course'] == 0) {
	if (mysqli_query($conn, "UPDATE student Set stu_course = $cou_id WHERE stu_id = $stu_id")) {
		echo "<p class='text-success'>Course added...<p>";
	}else{
		echo "<p class='text-danger'>Error occured...<p>";
	}
}else{
	echo "<p class='text-danger'>Course already assigned...</p>";
}