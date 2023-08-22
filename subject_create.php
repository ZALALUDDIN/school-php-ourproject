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
				<h3>Add New Subject</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Subject Information	</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php include('message.php') ?>
						<br />
						<form id="demo-form2" method="post" action="" class="form-horizontal form-label-left">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 offset-md-3">
									<label for="class_name">Class Name </label>
										<select id="class_name" name="class_name" class="form-control">
											<option value="">Select Class</option>
											<option value="One">One</option>
											<option value="Two">Two</option>
											<option value="Three">Three</option>
											<option value="Four">Four</option>
											<option value="Five">Five</option>
											<option value="Six">Six</option>
											<option value="Seven">Seven</option>
											<option value="Eight">Eight</option>
											<option value="Nine">Nine</option>
											<option value="Ten">Ten</option>
										</select>
									</div>
									<div class="col-sm-6 offset-md-3">
										<label for="name">Subject Name </label>
										<select id="name" name="name" class="form-control">
											<option value="">Select Subject</option>
											<option value="Bangla">Bangla</option>
											<option value="English">English</option>
											<option value="ICT">ICT</option>
											<option value="Mathmatic">Mathmatic</option>
											<option value="Science">Science</option>
											<option value="Social Studies">Social Studies</option>
											<option value="Islamic Studies">Islamic Studies</option>
										</select>
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="sub">Subjective </label>
										<input type="text" id="sub" name="sub" class="form-control ">
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="obj">Objective </label>
										<input type="text" id="obj" name="obj" class="form-control ">
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="prac">Practical </label>
										<input type="text" id="prac" name="prac" class="form-control ">
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="pass">Pass Mark </label>
										<input type="text" id="pass" name="pass" class="form-control ">
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="status">Status</label>
										<select id="status" name="status" class="form-control">
											<option value="1">Active</option>
											<option value="0">Inactive</option>
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
							 
								$_POST['created_at']=date('Y-m-d H:i:s');
								$_POST['created_by']=$_SESSION['userdata']->id;

							  $result=$mysqli->common_create('subject',$_POST);
							  if($result['error']){
								$_SESSION['class']="danger";
								$_SESSION['msg']=$result['error'];
								echo "<script> location.replace('$base_url/subject_create.php')</script>";
							  }else{
								$_SESSION['class']="success";
								$_SESSION['msg']=$result['msg'];
								echo "<script> location.replace('$base_url/subject_list.php')</script>";
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