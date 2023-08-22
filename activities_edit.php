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
				<h3>Add Activities</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Activities details	</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php include('message.php') ?>
                        <?php
							$id=$_GET['id'];    
							$w['id']=$id;
							$user_data=$mysqli->common_select_single('activities','*',$w)['selectdata'];
						?>
						<br />
						<form id="demo-form2" method="post" action="" class="form-horizontal form-label-left">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 offset-md-3">
										<label for="studentid">Student ID </label>
										<input type="number" id="studentid" name="studentid" class="form-control" value="<?= $user_data->studentid ?>">
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="present">Present </label>
										<input type="text" id="present" name="present" class="form-control" value="<?= $user_data->present ?>">
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="absent">Absent </label>
										<input type="text" id="absent" name="absent" class="form-control" value="<?= $user_data->absent ?>">
									</div>
                                    <div class="col-sm-6 offset-md-3">
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
							  $result=$mysqli->common_update('activities',$_POST,$upwhere);
							  if($result['error']){
								$_SESSION['class']="danger";
								$_SESSION['msg']=$result['error'];
								echo "<script> location.replace('$base_url/activities_update.php?id=$id')</script>";
							  }else{
								$_SESSION['class']="success";
								$_SESSION['msg']=$result['msg'];
								echo "<script> location.replace('$base_url/activities_list.php')</script>";
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