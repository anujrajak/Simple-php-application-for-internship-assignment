<?php
require 'config.php';

$conn = connection();

$id = $_REQUEST['id'];

$data1 = mysqli_query($conn, "SELECT * FROM `student` s INNER JOIN course c ON c.cou_id=s.stu_course INNER JOIN `course-subject` cs ON cs.cs_cid = c.cou_id INNER JOIN subject su on su.sub_id=cs.cs_sid  INNER JOIN marks m ON m.course_subject_id = cs.cs_id WHERE s.stu_id = $id");

?>

<table class="table">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Name</th>
			<th scope="col">Course</th>
			<th scope="col">Subject</th>
			<th scope="col">Marks obtained</th>
		</tr>
	</thead>
	<tbody>
		<?php $s=0; foreach ($data1 as $row4) { $s++; ?>
			<tr>
				<td><?php echo $s; ?></td>
				<td><?php echo ucwords($row4['stu_name']) ?></td>
				<td><?php echo ucwords($row4['cou_name']) ?></td>
				<td><?php echo ucwords($row4['sub_name']) ?></td>
				<td><?php echo $row4['marks'] ?></td>
			</tr>
		<?php	}	?>
	</tbody>
</table>