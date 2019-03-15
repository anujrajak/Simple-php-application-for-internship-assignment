<?php
// import config file to get mysql connection
require "config.php";
$conn = connection();
$course = mysqli_query($conn, "SELECT * FROM `course` ORDER BY `cou_name`");
$student = mysqli_query($conn, "SELECT * FROM `student` ORDER BY `stu_name`");
$subject = mysqli_query($conn, "SELECT * FROM `subject` ORDER BY `sub_name`");
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title>Student Management</title>
</head>
<body style="background:linear-gradient(135deg, #0FF0B3 0%,#036ED9 100%) no-repeat;">

	<div class="container">
		<!-- <div class="card">
			<div class="card-body">

			</div>
		</div> -->
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<h3>1.	Assign course to student</h3>  				
						<div class="form-group">
							<label>Student</label>
							<select class="form-control" id="student">
								<option>Select Student</option>
								<?php foreach ($student as $row1) { ?>
									<option value="<?php echo $row1['stu_id'] ?>"><?php echo ucwords($row1['stu_name']) ?></option>
								<?php	}	?>
							</select>
						</div>
						<div class="form-group">
							<label>Courses</label>
							<select class="form-control" id="course">
								<option>Select course</option>
								<?php foreach ($course as $row) { ?>
									<option value="<?php echo $row['cou_id'] ?>"><?php echo ucwords($row['cou_name']) ?></option>
								<?php	}	?>
							</select>
						</div>
						<div id="assignCourseOutput"></div>
						<button type="button" class="btn btn-success btn-block" onclick="assignCourse();">Save</button>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<h3>2.	Assign subjects to course</h3>
						<div class="form-group">
							<label>Courses</label>
							<select class="form-control" id="subtocou_course">
								<option>Select Student</option>
								<?php foreach ($course as $row2) { ?>
									<option value="<?php echo $row2['cou_id'] ?>"><?php echo ucwords($row2['cou_name']) ?></option>
								<?php	}	?>
							</select>
						</div>
						<div class="form-group">
							<label>Subjects</label>
							<select class="form-control" id="subtocou_subject">
								<option>Select subject</option>
								<?php foreach ($subject as $row3) { ?>
									<option value="<?php echo $row3['sub_id'] ?>"><?php echo ucwords($row3['sub_name']) ?></option>
								<?php	}	?>
							</select>
						</div>
						<div id="assignSubjectOutput"></div>
						<button type="button" class="btn btn-success btn-block" onclick="assignSubject();">Save</button>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h3>3.	Give marks to students</h3>
						<div class="form-group">
							<label>Student</label>
							<select class="form-control" id="marksStudent" onchange="getinfo(this.value);">
								<option>Select Student</option>
								<?php foreach ($student as $row1) { ?>
									<option value="<?php echo $row1['stu_id'] ?>"><?php echo ucwords($row1['stu_name']) ?></option>
								<?php	}	?>
							</select>
						</div>
						<div id="marksEntry">
							
						</div>
						<div id="marksOutput">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- Optional JavaScript -->
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<script type="text/javascript">
		function assignCourse(){
			var course = $('#course').val();
			var student = $('#student').val();
    		// console.log(course+" "+student);
    		$.ajax({
    			type: "POST",
    			url: 'assignCourse.php',
    			data: {course:course,student:student},
    			success:function(msg) {
    				$('#assignCourseOutput').html(msg);
    			}
    		});
    	}
    </script>
    <script type="text/javascript">
    	function assignSubject(){
    		var course = $('#subtocou_course').val();
    		var subject = $('#subtocou_subject').val();
    		// console.log(course+" "+student);
    		$.ajax({
    			type: "POST",
    			url: 'assignSubject.php',
    			data: {course:course,subject:subject},
    			success:function(msg) {
    				$('#assignSubjectOutput').html(msg);
    			}
    		});
    	}
    </script>
    <script type="text/javascript">
    	function getinfo(id){
    		$.ajax({
    			type: "POST",
    			url: 'getinfo.php',
    			data: {id:id},
    			success:function(msg) {
    				$('#marksEntry').html(msg);
    			}
    		});
    		$.ajax({
    			type: "POST",
    			url: 'fetchMarks.php',
    			data: {id:id},
    			success:function(msg) {
    				$('#marksOutput').html(msg);
    			}
    		});
    	}
    </script>

    <script type="text/javascript">
    	function marksSave(couId,stuId,value){
    		$.ajax({
    			type: "POST",
    			url: 'marksSave.php',
    			data: {couId:couId,stuId:stuId,value:value},
    			success:function(msg) {
    				// alert(msg);
    			}
    		});
    	}
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>