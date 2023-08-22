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
				<h3>Add New Fees</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Fees details</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php include('message.php') ?>
						<br />
						<form id="demo-form2" method="post" action="" class="form-horizontal form-label-left">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 offset-md-3">
										<label for="student_id" class="font-weight-bold">Student ID </label>
										<select id="student_id" name="student_id" class="form-control">
											<option value="">Select Student ID</option>
											<?php
												$students=$mysqli->common_select('students');
												if(!$students['error']){
													foreach($students['selectdata'] as $stu){ ?>
														<option value="<?= $stu->id ?>"><?= "Roll No(".$stu->id.") " .$stu->studentName ?></option>
											<?php	}
												}
											?>
										</select>
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="years" class="font-weight-bold">Year </label>
										<select id="years" name="years" class="form-control">
											<?php for($y=2021; $y <= date('Y'); $y++){ ?>
												<option value="<?= $y ?>"><?= $y ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-6 offset-md-3">
										<label for="months" class="font-weight-bold">Month </label>
										<select id="months" name="months" class="form-control">
											<option value="">Select Month</option>
											<option value="1">January</option>
											<option value="2">February</option>
											<option value="3">March</option>
											<option value="4">April</option>
											<option value="5">May</option>
											<option value="6">June</option>
											<option value="7">July</option>
											<option value="8">August</option>
											<option value="9">September</option>
											<option value="10">October</option>
											<option value="11">November</option>
											<option value="12">December</option>
										</select>
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<fieldset class="form-group border">
											<legend class="w-auto px-2 mb-0">Fees Category</legend>
												<div class="form-group">
										
													<?php
														$fees_id=$mysqli->common_select('fees_category');
														if(!$fees_id['error']){
															foreach($fees_id['selectdata'] as $fee){ ?>
															<div class="pl-2 mt-2 mb-3">
																<label for="" class="">
																	<?= $fee->name ?> (<?= $fee->amount?>) - 
																	<input class="fees_cat" onchange="get_total()" type="checkbox" name="fees_id[]" data-fee="<?= $fee->amount?>" value="<?= $fee->id?>-<?= $fee->amount?>">
																</label>
															</div>
													<?php	}
														}
													?>
												</div>
										</fieldset>
									</div>
									
									<div class="col-sm-6 offset-md-3">
										<label for="total_amount" class="font-weight-bold">Total Amount </label>
										<input type="text" id="total_amount" name="amount" class="form-control ">
									</div>
									<div class="col-sm-6 offset-md-3">
										<label for="payment" class="font-weight-bold">Pay Amount </label>
										<input type="text" id="payment" name="payment" onkeyup="checktotal(this)" class="form-control ">
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
								$data['student_id']=$_POST['student_id'];
								$data['months']=$_POST['months'];
								$data['years']=$_POST['years'];
								$data['total']=$_POST['amount'];
								$data['payment']=$_POST['payment'];
								$data['created_at']=date('Y-m-d H:i:s');
								$data['created_by']=$_SESSION['userdata']->id;

							  $result=$mysqli->common_create('student_fee',$data);
							  if($result['error']){
								$_SESSION['class']="danger";
								$_SESSION['msg']=$result['error'];
								echo "<script> location.replace('$base_url/stu_fee_create.php')</script>";
							  }else{
								$fees_id=$result['insert_id'];
								foreach($_POST['fees_id'] as $fee_cat){
									$fees=explode('-',$fee_cat);
									$fees_det['student_fee_id']=$fees_id;
									$fees_det['student_id']=$_POST['student_id'];
									$fees_det['fees_id']=$fees[0];
									$fees_det['amount']=$fees[1];

									$mysqli->common_create('student_fees_details',$fees_det);
								}

								$_SESSION['class']="success";
								$_SESSION['msg']=$result['msg'];
								echo "<script> location.replace('$base_url/stu_fee_list.php')</script>";
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
	function get_total(){
		var fees=0
		$('input:checkbox:checked').each(function(e){
			fees+=parseFloat($(this).data('fee'));
		});
		$('#total_amount').val(fees);
	}
	function checktotal(){
		var total=parseFloat($('#total_amount').val());
		var payment=parseFloat($('#payment').val());
		if(payment > total){
			alert("you cannot pay more than "+ total);
			$('#payment').val(total);
		}
	}
</script>