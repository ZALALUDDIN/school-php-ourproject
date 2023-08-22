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
				<h3>Add New Routine</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<?php include('message.php') ?><br />
						<form id="demo-form2" method="post" action="" class="form-horizontal form-label-left">
							<div class="form-group">
								<div class="row">	
									<div class="col-sm-6 offset-md-3">
										<label for="class_name" class="font-weight-bold">Class </label>
										<select onchange="get_subject(this.value)" id="class_name" name="class_name" class="form-control">
											<option value="">Select Class</option>
											<option value="One">One</option>
											<option value="Two">Two</option>
											<option value="Three">Three</option>
											<option value="Four">Four</option>
											<option value="Five">Five</option>
										</select>
									</div>

									<div class="col-sm-6 offset-md-3">
										<label for="subject_id" class="font-weight-bold">Subject</label>
										<select onchange="get_subject_marks(this)" id="subject_id" name="sub_id" class="form-control">
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
									<div class="col-sm-6 offset-md-3">
										<label for="day" class="font-weight-bold">Days </label>
										<select id="day" name="day" class="form-control" onchange="get_teacher_status()">
											<option value="1">Saturday</option>
											<option value="2">Sunday</option>
											<option value="3">Monday</option>
											<option value="4">Tuesday</option>
											<option value="5">Wednesday</option>
											<option value="6">Thursday</option>
										</select>
									</div>
									<div class="col-sm-6 offset-md-3">
										<label for="time" class="font-weight-bold"> Time </label>
										<select id="time" name="time" class="form-control" onchange="get_teacher_status()">
											<option value="">Select Time</option>
											<option value="1">08:00-8:45AM 1st</option>
											<option value="2">08:45-09:30AM 2nd</option>
											<option value="3">09:30-10:15AM 3rd</option>
											<option value="4">10:15-11:00AM 4th</option>
											<option value="5">11:00-11:30AM Tiffen</option>
											<option value="6">11:30-12:15PM 5th</option>
											<option value="7">12:15-01:00PM 6th</option>
										</select>
									</div>
									
									<div class="col-sm-6 offset-md-3">
										<label for="teacher_id" class="font-weight-bold">Teacher </label>
										<select id="teacher_id" name="teacher_id" class="form-control" onchange="get_teacher_status()">
										<?php
											$teacher=$mysqli->common_select('teacher');
											if(!$teacher['error']){ ?>
											<option value="">Select Teacher</option>
												<?php foreach($teacher['selectdata'] as $tech){ ?>
											<option value="<?= $tech->id ?>"><?= $tech->teacherName ?></option>
											<?php	} } ?>
										</select>
									</div>
									<div class="ln_solid"></div>
									<div class="col-md-9 col-sm-9 offset-md-3 mt-2">
										<button type="submit" class="btn btn-success">Submit</button>
										<button class="btn btn-primary" type="reset">Reset</button>
									</div>
								</div>
							</div>
						</form>
						<?php
							if($_POST){
								$result=$mysqli->common_create('routine',$_POST);
								if($result['error']){
									$_SESSION['class']="danger";
									$_SESSION['msg']=$result['error'];
									echo "<script> location.replace('$base_url/create_routine.php')</script>";
								}else{
									$_SESSION['class']="success";
									$_SESSION['msg']=$result['msg'];
									echo "<script> location.replace('$base_url/class_routine_view.php')</script>";
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
	function get_subject(e){
		/* show hide subject according to class */
		$('#subject_id option').hide();
		$('#subject_id').find('.subs'+e).show();
	}
</script>

<script>
	function get_teacher_status(){
		var teacher_id=$('#teacher_id').val();
		var day=$('#day').val();
		var time=$('#time').val();
		if(teacher_id){
			$.ajax({
				url: 'get_teacher_status.php?teacher_id='+teacher_id+'&day='+day+'&time='+time,
				type: 'post',
				dataType: 'json',
				contentType: 'application/json',
				success: function (data) {
					if(data>0){
						alert("This teacher is not availabel at this time and day");
						$('#teacher_id').val("");
					}
				},error: function(xhr, status, errorMessage) {
					alert(errorMessage);
				}
			});
		}
	
	}
</script>
