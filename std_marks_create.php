<?php include('include/header.php') ?>
<?php include('include/sidebar.php'); ?>
<!-- top navigation -->
<?php include('include/topnav.php'); ?>
<!-- /top navigation -->
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Add New Marks</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Marks details</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php include('message.php') ?>
						<br />
						<form id="demo-form2" method="post" action="" class="form-horizontal form-label-left">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 offset-md-3">
										<label for="term_id">Exam Term </label>
										<select id="term_id" name="term_id" class="form-control">
											<option value="">Select Term</option>
											<?php
												$terms=$mysqli->common_select('term');
												if(!$terms['error']){
													foreach($terms['selectdata'] as $term){ ?>
														<option value="<?= $term->id ?>"><?= $term->term ?></option>
											<?php	}
												}
											?>
										</select>
									</div>
									<div class="col-sm-6 offset-md-3">
										<label for="class_name">Class </label>
										<select onchange="get_student(this.value)" id="class_name" name="class_name" class="form-control">
											<option value="">Select Class</option>
											<option value="One">One</option>
											<option value="Two">Two</option>
											<option value="Three">Three</option>
											<option value="Four">Four</option>
											<option value="Five">Five</option>
										</select>
									</div>
									
									<div class="col-sm-6 offset-md-3">
										<label for="student_id">Student </label>
										<select id="student_id" name="student_id" class="form-control">
											<option value="">Select Student</option>
											<?php
												$students=$mysqli->common_select('students');
												if(!$students['error']){
													foreach($students['selectdata'] as $stu){ ?>
														<option class="hidden cls<?= $stu->class ?>" value="<?= $stu->id ?>"><?= "Roll No(".$stu->classRoll.") " .$stu->studentName ?></option>
											<?php	}
												}
											?>
										</select>
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="subject_id">Subject </label>
										<select onchange="get_subject_marks(this)" id="subject_id" name="subject_id" class="form-control">
											<option value="">Select Subject</option>
											<?php
												$subject=$mysqli->common_select('subject');
												if(!$subject['error']){
													foreach($subject['selectdata'] as $sub){ ?>
														<option data-markssub="<?= $sub->sub ?>" data-marksobj="<?= $sub->obj ?>" data-marksprac="<?= $sub->prac ?>" class="subs<?= $sub->class_name ?>  hidden" value="<?= $sub->id ?>"><?= $sub->name ?></option>
											<?php	}
												}
											?>
										</select>
									</div>
									<input type="hidden" name="old_marks" id="old_marks" value="0">

                                    <div class="col-sm-6 offset-md-3 sub_marks_entry hidden">
										<label for="sub">Subjective </label>
										<input type="number" id="sub" name="sub" class="form-control ">
									</div>
                                    <div class="col-sm-6 offset-md-3 obj_marks_entry hidden">
										<label for="obj">Objective </label>
										<input type="number" id="obj" name="obj" class="form-control ">
									</div>
                                    <div class="col-sm-6 offset-md-3 prac_marks_entry hidden">
										<label for="prac">Practical </label>
										<input type="number" id="prac" name="prac" class="form-control ">
									</div>
								</div>
								
							</div>
                            <div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-6 col-sm-6 offset-md-3">
									<button type="submit" class="btn btn-success">Submit</button>
									<button class="btn btn-primary" type="reset">Reset</button>
								</div>
							</div>
						</form>
						<?php
							if($_POST){
								$data['class_name']=$_POST['class_name'];
								$data['student_id']=$_POST['student_id'];
								$data['subject_id']=$_POST['subject_id'];
								$data['term_id']=$_POST['term_id'];
								$data['sub']=$_POST['sub'];
								$data['obj']=$_POST['obj'];
								$data['prac']=$_POST['prac'];
								
								$total=($_POST['sub']+$_POST['obj'] + $_POST['prac']);

								if($total > 79){
									$gp="5.00";$gl="A+";
								}else if($total > 69){
									$gp="4.00";$gl="A";
								}else if($total > 59){
									$gp="3.50";$gl="A-";
								}else if($total > 49){
									$gp="3.00";$gl="B";
								}else if($total > 39){
									$gp="2.00";$gl="C";
								}else if($total > 32){
									$gp="1.00";$gl="D";
								}else{
									$gp="0.00";$gl="F";
								}
								
								$data['total']=$total;
								$data['gp']=$gp;
								$data['gl']=$gl;
								$data['created_at']=date('Y-m-d H:i:s');
								$data['created_by']=$_SESSION['id'];
							if($_POST['old_marks'] == 0){
								$result=$mysqli->common_create('student_marks',$data);
							}else{
								$where_marks['id']=$_POST['old_marks'];
								$result=$mysqli->common_update('student_marks',$data,$where_marks);
							}
							  
							  if($result['error']){
								$_SESSION['class']="danger";
								$_SESSION['msg']=$result['error'];
								echo "<script> location.replace('$base_url/std_marks_create.php')</script>";
							  }else{
								$_SESSION['class']="success";
								$_SESSION['msg']=$result['msg'];
								echo "<script> location.replace('$base_url/std_marks.php')</script>";
							  }
							}
						?>


					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- /page content -->


<?php include('include/footer.php'); ?>

<script>
	function get_student(e){
		/* show hide student according to class */
		$('#student_id option').hide();
		$('#student_id').find('.cls'+e).show();
		/* show hide subject according to class */
		$('#subject_id option').hide();
		$('#subject_id').find('.subs'+e).show();
	}
</script>

<script>
	function get_subject_marks(e){
		$('#old_marks').val(0);
		$('#sub').val(0);
		$('#obj').val(0);
		$('#prac').val(0);

		if($(e).children('option:selected').data('markssub') > 0)
			$('.sub_marks_entry').show();
		else
			$('.sub_marks_entry').hide();
		
		if($(e).children('option:selected').data('marksobj') > 0)
			$('.obj_marks_entry').show();
		else
			$('.obj_marks_entry').hide();
		
		if($(e).children('option:selected').data('marksprac') > 0)
			$('.prac_marks_entry').show();
		else
			$('.prac_marks_entry').hide();

		var student_id=$('#student_id').val();
		var subject_id=$('#subject_id').val();
		var term_id=$('#term_id').val();
		$.ajax({
            url: 'std_marks_edit.php?term_id='+term_id+'&student_id='+student_id+'&subject_id='+subject_id,
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
				if(data.data){
					$('#old_marks').val(data.data.id);
					$('#sub').val(data.data.sub);
					$('#obj').val(data.data.obj);
					$('#prac').val(data.data.prac);
				}
            },error: function(xhr, status, errorMessage) {
				alert(errorMessage);
			}
        });
	
	}
</script>