<?php


function connection(){
	$conn = mysqli_connect('localhost', 'root', '', 'ved');

	if ($conn) {
		// if connection successful
		// echo "Connection successful...";
		return  $conn;
	}
	else{
		// if error in connection
		echo "Error in connection...";
	}	
}