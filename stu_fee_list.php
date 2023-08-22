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
                <h3>Student Fee</h3>
            </div>
        </div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
					<div class="x_title">
						<h2>Fees List </h2>
						<a href="stu_fee_create.php" class="btn btn-primary float-right">Add New</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box table-responsive">
								<?php include('message.php') ?>
									<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>#SL</th>
												<th>Student</th>
												<th>Amount</th>
												<th>Month</th>
												<th>Year</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>

                      <tbody>
					  <?php
                        $result=$mysqli->custom_select("SELECT student_fee.*, students.studentName FROM `student_fee` JOIN students ON students.id=student_fee.student_id");
                        if($result['numrows'] > 0){
                            foreach($result['selectdata'] as $i=>$student_fee){
                    ?> 
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $student_fee->studentName ?></td>
                                <td><?= $student_fee->total ?></td>
                                <td><?= date("F", mktime(0, 0, 0, $student_fee->months, 1));  ?></td>
                                <td><?= $student_fee->years ?></td>
								<td> <?= $student_fee->total > $student_fee->payment?"Due-".($student_fee->total - $student_fee->payment):"Paid" ?></td>
                                <td>
									<?php if($student_fee->total > $student_fee->payment){ ?>
										<button onclick="stu_due_set('<?= $student_fee->studentName ?>','<?=($student_fee->total - $student_fee->payment) ?>','<?= $student_fee->payment ?>',<?= $student_fee->id ?>)" data-toggle="modal" data-target="#payment" class="btn btn-xs btn-warning" title="Pay"><i class="fa fa-money" aria-hidden="true"></i></button>
									<?php } ?> 
                                    <a href="stu_fee_edit.php?id=<?= $student_fee->id ?>" class="btn btn-xs btn-info" title="Update"><i class="fa fa-edit"></i></a>
                                    <a onclick="return confirm('Are you sure to delete?')" href="stu_fee_delete.php?id=<?= $student_fee->id ?>" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                    <a href="std_invoice.php?id=<?= $student_fee->id ?>" class="btn btn-warning" title="Invoice"><i class="fas fa-file-invoice fa-spin"></i></a>

                                </td>
                            </tr>
                    <?php  }
                        }
                    ?>
									</tbody>
								</table>


								<?php
							if($_POST){
								$whereuppay['id']=$_POST['ids'];
								$data['payment']=$_POST['old_pay'] + $_POST['payment'];
								$data['last_pay_date']=date('Y-m-d');

							  $result=$mysqli->common_update('student_fee',$data,$whereuppay);
							  if($result['error']){
								$_SESSION['class']="danger";
								$_SESSION['msg']=$result['error'];
								echo "<script> location.replace('$base_url/stu_fee_list.php')</script>";
							  }else{
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
            </div>
		</div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="" method="post">
		<div class="modal-body">
			<div class="form-group">
				<div class="row">
					<div class="col-12">
						<label for="">Due</label>
						<input type="text" class="form-control" id="dueamt" readonly>
						<input type="hidden" id="ids" name="ids" >
						<input type="hidden" id="old_pay" name="old_pay" >
					</div>
					<div class="col-12">
						<label for="">Payment</label>
						<input type="text" onkeyup="checktotal()" class="form-control" name="payment" id="pay_amount">
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Pay</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<?php include('include/footer.php'); ?>
<script>
	function stu_due_set(stuname,due,old_pay,ids){
		$('#exampleModalLabel').text(stuname);
		$('#dueamt').val(due);
		$('#ids').val(ids);
		$('#old_pay').val(old_pay);
	}

	function checktotal(){
		
		var dueamt=parseFloat($('#dueamt').val());
		var pay_amount=parseFloat($('#pay_amount').val());
		if(pay_amount > dueamt){
			alert("you cannot pay more than "+ dueamt);
			$('#pay_amount').val(dueamt);
		}
	}

</script>