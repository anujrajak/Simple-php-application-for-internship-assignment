<?php
require 'config.php';

$conn = connection();

$id = $_REQUEST['id'];

$data = mysqli_query($conn, "SELECT * FROM `student` s INNER JOIN course c ON c.cou_id=s.stu_course INNER JOIN `course-subject` cs ON cs.cs_cid = c.cou_id INNER JOIN subject su on su.sub_id=cs.cs_sid WHERE s.stu_id = $id");

foreach ($data as $key) {}

?>

<h5>Course Name : <?php echo ucwords($key['cou_name']); ?></h5>
<h5>Subjects : </h5>
<ul class="list-group">
	<?php $s=0; foreach ($data as $row) { $s++;	?>
		<li class="list-group-item">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label"><?php echo ucwords($row['sub_name'])." :"; ?></label>
				<div class="col">
					<input type="number" class="form-control" name="sub_<?php echo $s; ?>" id="<?php echo $row['cs_id']; ?>" value="<?php echo $row['marks'] ?>" onkeyup="marksSave(this.id,<?php echo $row['stu_id'] ?>,this.value)">
				</div>
			</div>
		</li>
	<?php } ?>
</ul>