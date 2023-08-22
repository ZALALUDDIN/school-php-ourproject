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
				<h3>Show Routine</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<?php include('message.php') ?><br />
						<form id="demo-form2" method="get" action="" class="form-horizontal form-label-left">
							<div class="form-group">
								<div class="row">	
									<div class="col-sm-6 offset-md-3">
										<label for="class_name" class="font-weight-bold">Class </label>
										<select id="class_name" name="class_name" class="form-control">
											<option value="">Select Class</option>
											<option value="One">One</option>
											<option value="Two">Two</option>
											<option value="Three">Three</option>
											<option value="Four">Four</option>
											<option value="Five">Five</option>
										</select>
									</div>
									
									<div class="ln_solid"></div>
									<div class="col-md-9 col-sm-9 offset-md-3 mt-2">
										<button type="button" onclick="get_teacher_status()" class="btn btn-success">Submit</button>
									</div>
								</div>
							</div>
						</form>
						<div class="show">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- /page content -->


<?php include('include/footer.php'); ?>
<script>
	function get_teacher_status(){
		var class_name=$('#class_name').val();
		$.ajax({
            url: 'class_routine_print_json.php?class_name='+class_name,
            type: 'get',
            dataType: 'html',
            success: function (data) {
				$('.show').html(data);
            },error: function(xhr, status, errorMessage) {
				alert(errorMessage);
			}
        });
	
	}
</script>
