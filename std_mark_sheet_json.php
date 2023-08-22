<?php include_once("include/connection.php"); ?>
<?php if(!isset($_SESSION['id'])) header('location:login.php'); ?>
<?php
	$student_id=$_GET['student_id'];
	$term_id=$_GET['term_id'];
	$class_name=$_GET['class_name'];
	$sql="SELECT student_marks.*,subject.name FROM `student_marks` 
	join subject on subject.id=student_marks.subject_id
	where student_marks.student_id='$student_id' and student_marks.term_id='$term_id'
	and student_marks.class_name='$class_name'";
	$marksheet=$mysqli->custom_select($sql);
	$wherestu['id']=$_GET['student_id'];
	$student=$mysqli->common_select_single('students','*',$wherestu)['selectdata'];
	if($marksheet['error'] || $marksheet['numrows'] <= 0){
		echo $marksheet['msg'];
		exit;
	}
?>
<div class="row">
	<div class="col-12 mt-3 mb-3 text-center">
	 <img src="images/school-logo2.png" class="img-fluid" width="140px" height="auto" alt="Responsive image">
	</div>
	<div class="col-12">
		<h1 class="text-center">
			Moheshpur Primary School
		</h1>
		<address class="text-center">
			<b> Moheshpur, Barura, Cumilla</b>
		</address>
	</div>
	<div class="col-12">
		<h3 class="text-center">
			<?= $_GET['exam_term']?>
		</h3>
	</div>
</div>
<table class="table table-dark">
	<tr>
		<td><b>Student Name:</b> <?= $student->studentName ?></td>
		<td><b>Role No:</b> <?= $student->classRoll ?></td>
		<td><b>Class:</b> <?= $student->class ?></td>
	</tr>
</table>
<table class="table">
	<tr>
		<th>Subject</th>
		<th>Sub</th>
		<th>Obj</th>
		<th>Prac</th>
		<th>Total</th>
		<th>GP</th>
		<th>GL</th>
	</tr>
	<?php 
		$subcount=$totalmark=$total_gp=0;
		foreach($marksheet['selectdata'] as $mark){
			$subcount++;
			$totalmark+=$mark->total;
			$total_gp+=$mark->gp;
	?>
		<tr>
			<td><?= $mark->name ?></td>
			<td><?= $mark->sub ?></td>
			<td><?= $mark->obj ?></td>
			<td><?= $mark->prac ?></td>
			<td><?= $mark->total ?></td>
			<td><?= $mark->gp ?></td>
			<td><?= $mark->gl ?></td>
		</tr>
	<?php } ?>
</table>
<table class="table table-dark">
	<tr>
		<th>Total Marks</th>
		<th>Total GP</th>
		<th>GP</th>
		<th>GL</th>
	</tr>
	<tr>
		<td><?= $totalmark ?></td>
		<td><?= $total_gp ?></td>
		<td><?= round($total_gp/$subcount ,2) ?></td>
		<td>
			<?php
			$avggp=round($total_gp/$subcount ,2);
				if($avggp >=5){
					echo "A+";
				}else if($avggp >= 4){
					echo "A";
				}else if($avggp >= 3.5){
					echo "A-";
				}else if($avggp >= 3){
					echo "B";
				}else if($avggp >= 2){
					echo "C";
				}else if($avggp >= 1){
					echo "D";
				}else{
					echo "F";
				}
			?>
		</td>
	</tr>
</table>
<table class="table mt-5" style="border-top:0">
	<tr>
		<td style="border-top:0">
			<span style="border-top:1px solid black">Headmaster Signature</span>
		</td>
		<td style="border-top:0">
			<span style="border-top:1px solid black">Class Teacher Signature</span>
		</td>
		<td style="border-top:0">
			<span style="border-top:1px solid black">Guardian Signature</span>
		</td>
	</tr>
</table>