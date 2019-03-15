<?php
require 'config.php';

$conn = connection();

$sid = $_REQUEST['stuId'];
$csid = $_REQUEST['couId'];
$marks = $_REQUEST['value'];

$check = mysqli_query($conn, "SELECT * FROM `marks` WHERE `student_id` = $sid AND `course_subject_id` = $csid");
$count = mysqli_num_rows($check);

if ($count == 0) {
	echo $rs = "INSERT INTO `marks` (`id`, `student_id`, `course_subject_id`, `marks`) VALUES (NULL, '$sid', '$csid', '$marks')";
	mysqli_query($conn, $rs);
}else{
	echo mysqli_query($conn, "UPDATE `marks` SET `marks` = '$marks' WHERE `student_id` = $sid AND `course_subject_id` = $csid");
}

