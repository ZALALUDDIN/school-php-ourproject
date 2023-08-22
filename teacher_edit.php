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
				<h3>Add New Teacher</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Teacher Information	</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php include('message.php') ?>
						<?php
							$id=$_GET['id'];    
							$w['id']=$id;
							$user_data=$mysqli->common_select_single('teacher','*',$w)['selectdata'];
						?>
						<br />
						<form id="demo-form2" method="post" action="" class="form-horizontal form-label-left">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="name">Teacher Name </label>
										<input type="text" id="teacherName" name="teacherName" class="form-control" value="<?= $user_data->teacherName ?>">
									</div>
									<div class="col-sm-6">
										<label for="designation">Designation </label>
										<input type="text" id="designation" name="designation" class="form-control" value="<?= $user_data->designation ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="birthDate">Date of Birth </label>
										<input type="date" id="birthDate" name="birthDate" class="form-control" value="<?= $user_data->birthDate ?>">
									</div>
									<div class="col-sm-4">
										<label for="subject">Subject </label>
										<input type="text" id="subject" name="subject" class="form-control" value="<?= $user_data->subject ?>">
									</div>
									<div class="col-sm-4">
										<label for="contactNo">Contact </label>
										<input type="text" id="contactNo" name="contactNo" class="form-control" value="<?= $user_data->contactNo ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="gender">Gender</label>
										<select id="gender" name="gender" class="form-control">
											<option value="Male"<?= $user_data->gender=="Male"?"selected":"" ?>>Male</option>
											<option value="Female" <?= $user_data->gender=="Female"?"selected":"" ?>>Female</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label for="status">Status</label>
										<select id="status" name="status" class="form-control">
											<option value="1" <?= $user_data->status=="1"?"selected":"" ?>>Active</option>
											<option value="0" <?= $user_data->status=="0"?"selected":"" ?>>Inactive</option>
										</select>
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
							 
								$_POST['updated_at']=date('Y-m-d H:i:s');
								$_POST['updated_by']=$_SESSION['userdata']->id;
								$upwhere['id']=$id;
							  $result=$mysqli->common_update('teacher',$_POST,$upwhere);
							  if($result['error']){
								$_SESSION['class']="danger";
								$_SESSION['msg']=$result['error'];
								echo "<script> location.replace('$base_url/teacher_update.php?id=$id')</script>";
							  }else{
								$_SESSION['class']="success";
								$_SESSION['msg']=$result['msg'];
								echo "<script> location.replace('$base_url/teacher_list.php')</script>";
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