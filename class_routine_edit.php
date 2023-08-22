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
				<h3>Update Routine</h3>
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
												<label for="teacher_id" class="font-weight-bold">Teacher ID </label>
												<select id="teacher_id" name="teacher_id" class="form-control">
													<option value="">Select Teacher</option>
													<?php
														$teacher=$mysqli->common_select('teacher');
														if(!$teachers['error']){
															foreach($teachers['selectdata'] as $tech){ ?>
																<option ><?= $tech->teacherName ?></option>
													<?php	}
														}
													?>
												</select>
											</div>
											<div class="col-sm-6 offset-md-3">
												<label for="class_id" class="font-weight-bold">Class ID </label>
												<select id="class_id" name="class_id" class="form-control">
													<option value="">Select Class</option>
													<?php
														$class=$mysqli->common_select('subject');
														if(!$clsses['error']){
															foreach($classes['selectdata'] as $cls){ ?>
																<option ><?= $cls->class ?></option>
													<?php	}
														}
													?>
												</select>
											</div>


											<div class="col-sm-6 offset-md-3">
												<label for="subject_id" class="font-weight-bold">Subject ID </label>
												<select id="subject_id" name="subject_id" class="form-control">
													<option value="">Select Subject</option>
													<?php
														$subject=$mysqli->common_select('subject');
														if(!$subjects['error']){
															foreach($subjects['selectdata'] as $sub){ ?>
																<option ><?= $sub->name ?></option>
													<?php	}
														}
													?>
												</select>
											</div>
											<div class="col-sm-6 offset-md-3">
												<label for="day" class="font-weight-bold">Days </label>
												<select id="day" name="day" class="form-control">
													<option value="">Select Day</option>
													<option value="1">Sunday</option>
													<option value="2">Monday</option>
													<option value="3">Tuesday</option>
													<option value="4">Wednesday</option>
													<option value="5">Thursday</option>
													<option value="6">Friday</option>
													<option value="7">Saturday</option>
												</select>
											</div>
											<div class="col-sm-6 offset-md-3">
												<label for="time" class="font-weight-bold"> Time </label>
												<input class="form-control" type="text" name="time" id="time">
											</div>
										</div>
										<div class="ln_solid"></div>
											<div class="item form-group">
												<div class="col-md-6 col-sm-6 offset-md-3">
													<button type="submit" class="btn btn-success">Submit</button>
													<button class="btn btn-primary" type="reset">Reset</button>
												</div>
											</div>
								</div>
							</div>
						</form>
						<?php
							if($_POST){
								$data['teacher_id']=$_POST['teacher_id'];
								$data['class_id']=$_POST['class_id'];
								$data['sub_id']=$_POST['sub_id'];
								$data['day']=$_POST['day'];
								$data['time']=$_POST['time'];
								$data['created_at']=date('Y-m-d H:i:s');
								$data['created_by']=$_SESSION['userdata']->id;

							  $result=$mysqli->common_create('routine',$data);
							  if($result['error']){
								$_SESSION['class']="danger";
								$_SESSION['msg']=$result['error'];
							  }else{
								// $fees_id=$result['insert_id'];
								// foreach($_POST['fees_id'] as $fee_cat){
								// 	$fees=explode('-',$fee_cat);
								// 	$fees_det['student_fee_id']=$fees_id;
								// 	$fees_det['student_id']=$_POST['student_id'];
								// 	$fees_det['fees_id']=$fees[0];
								// 	$fees_det['amount']=$fees[1];

								// 	$mysqli->common_create('class_routine_view',$fees_det);
								// }

								$_SESSION['class']="success";
								$_SESSION['msg']=$result['msg'];
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