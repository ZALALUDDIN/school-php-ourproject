<?php include('include/header.php') ?>
<?php include('include/sidebar.php'); ?>
<!-- top navigation -->
<?php include('include/topnav.php'); ?>
<!-- /top navigation -->
<!-- Content Wrapper. Contains page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Student Marks</h3>
            </div>
        </div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
					<div class="x_title">
						<h2>View Marks Sheet</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
								<?php include('message.php') ?>
									
								<form id="demo-form2" method="post" action="" class="form-horizontal form-label-left">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-3">
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
											<div class="col-sm-3">
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
											
											<div class="col-sm-3">
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
											<div class="col-sm-3 pt-4">
												<button onclick="std_mark_sheet_json()" type="button" class="btn btn-success">Submit</button>
											</div>
										</div>
										
									</div>
								</form>
								<div class="col-12">
									<button type="button" class="btn btn-info" onclick="printDiv('result_show')">Print Marksheet</button>
								</div>
								<div id="result_show">
								<!-- student result show here -->
								</div>
							</div>
						</div>
					</div><!-- x_content -->
				</div><!-- x_panel -->
            </div>
		</div>
	</div>
</div>

<?php include('include/footer.php'); ?>
<script>
	function get_student(e){
		/* show hide student according to class */
		$('#student_id option').hide();
		$('#student_id').find('.cls'+e).show();
	}
</script>

<script>
	function std_mark_sheet_json(){

		var exam_term=$('#term_id  option:selected').text();
		var student_id=$('#student_id').val();
		var class_name=$('#class_name').val();
		var term_id=$('#term_id').val();
		$.ajax({
            url: 'std_mark_sheet_json.php?exam_term='+exam_term+'&term_id='+term_id+'&student_id='+student_id+'&class_name='+class_name,
            type: 'get',
            dataType: 'html',
            success: function (data) {
				$('#result_show').html(data);
            },error: function(xhr, status, errorMessage) {
				console.log(errorMessage);
			}
        });
	
	}

	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>