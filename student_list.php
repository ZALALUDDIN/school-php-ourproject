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
                <h3>Students</h3>
            </div>
        </div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
					<div class="x_title">
						<h2>Student's List </h2>
						<a href="student_create.php" class="btn btn-primary float-right">Add New</a>
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
												<th>Student Name</th>
												<th>Gender</th>
												<th>Father's Name</th>
												<th>Mother's Name</th>
												<th>DOB</th>
												<th>Class</th>
												<th>Group</th>
												<th>Class Roll</th>
												<th>Contact</th>
												<th>Action</th>
											</tr>
										</thead>

                      <tbody>
					  <?php
                        $where['status']=1;
                        $result=$mysqli->common_select("students","*",$where);
                        if(!$result['error']){
                            foreach($result['selectdata'] as $i=>$student){
                    ?> 
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $student->studentName ?></td>
                                <td><?= $student->gender ?></td>
                                <td><?= $student->fatherName ?></td>
                                <td><?= $student->motherName ?></td>
                                <td><?= date('d-m-Y',strtotime($student->birthDate)) ?></td>
                                <td><?= $student->class ?></td>
                                <td><?= $student->groups ?></td>
                                <td><?= $student->classRoll ?></td>
                                <td><?= $student->contactNo ?></td>
                                <td>
                                    <a href="student_edit.php?id=<?= $student->id ?>" class="btn btn-xs btn-info" title="Update"><i class="fa fa-edit"></i></a>
                                    <a onclick="return confirm('Are you sure to delete?')" href="student_delete.php?id=<?= $student->id ?>" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                    <?php  }
                        }
                    ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
                </div>
            </div>
		</div>
	</div>
</div>

<?php include('include/footer.php'); ?>