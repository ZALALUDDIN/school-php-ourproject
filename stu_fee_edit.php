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
                        <?php
							$id=$_GET['id']; 
							// student fee data  
							$w['id']=$id;
							$user_data=$mysqli->common_select_single('student_fee','*',$w)['selectdata'];
							// student fee detalis data 
							$wf['student_fee_id']=$id;
							$fees_data=$mysqli->common_select('student_fees_details','*',$wf)['selectdata'];
							// student data 
							$sw['id']=$user_data->student_id;
							$student=$mysqli->common_select_single('students','*',$sw)['selectdata'];
						?>
						<br />
						<form id="demo-form2" method="post" action="" class="form-horizontal form-label-left">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 offset-md-3">
										<label for="student_id">Student Name </label>
										<input type="text" readonly class="form-control" value="<?= $student->studentName ?> (<?= $student->classRoll ?>)">
									</div>
									<div class="col-sm-6 offset-md-3">
										<label for="years">Year </label>
										<input type="text" readonly class="form-control" value="<?= $user_data->years ?>">
									</div>
                                    <div class="col-sm-6 offset-md-3">
										<label for="months">Month </label>
										<input type="text" readonly class="form-control" value="<?= date("F", mktime(0, 0, 0, $user_data->months, 1)); ?>">
									</div>
									<div class="col-sm-6 offset-md-3">
										<fieldset class="form-group border">
											<legend class="w-auto px-2 mb-0">Fees Category</legend>
												<div class="form-group">
													<?php
													function fee_ck($fees_data,$feeid){
														foreach($fees_data as $oldfee){
															if($oldfee->fees_id==$feeid)
																return "checked";
														}
													}
														$fees_id=$mysqli->common_select('fees_category');
														if(!$fees_id['error']){
															foreach($fees_id['selectdata'] as $fee){ ?>
															<div class="pl-2 mt-2 mb-3">
																<label for="" class="">
																	<?= $fee->name ?> (<?= $fee->amount?>) - 
																	<input class="fees_cat" onchange="get_total()" type="checkbox" <?= fee_ck($fees_data,$fee->id) ?> name="fees_id[]" data-fee="<?= $fee->amount?>" value="<?= $fee->id?>-<?= $fee->amount?>">
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
										<input type="text" id="total_amount" name="amount" class="form-control " value="<?= $user_data->total ?>">
									</div>
									<div class="col-sm-6 offset-md-3">
										<label for="payment" class="font-weight-bold">Pay Amount </label>
										<input type="text" value="<?= $user_data->payment ?>" id="payment" name="payment" onkeyup="checktotal(this)" class="form-control ">
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
								$data['total']=$_POST['amount'];
								$data['payment']=$_POST['payment'];
								$data['updated_at']=date('Y-m-d H:i:s');
								//$data['updated_by']=$_SESSION['userdata']->id;
								$wfee['id']=$id;
							  $result=$mysqli->common_update('student_fee',$data,$wfee);
							  if($result['error']){
								$_SESSION['class']="danger";
								$_SESSION['msg']=$result['error'];
								echo "<script> location.replace('$base_url/stu_fee_create.php')</script>";
							  }else{
								$fees_id=$id;
								$fdw['student_fee_id']=$id;
								$del=$mysqli->common_delete('student_fees_details',$fdw);
								
								foreach($_POST['fees_id'] as $fee_cat){
									$fees=explode('-',$fee_cat);
									$fees_det['student_fee_id']=$fees_id;
									$fees_det['student_id']=$student->id;
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
		checktotal();
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