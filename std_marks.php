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
						<h2>View Marks </h2>
						<a href="std_marks_create.php" class="btn btn-primary float-right">Add New</a>
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
												<th>Term</th>
												<th>Student</th>
												<th>Roll</th>
												<th>Subject</th>
												<th>Class</th>
												<th>Sub</th>
												<th>Obj</th>
												<th>Prac</th>
												<th>Total</th>
												<th>Grade Point</th>
												<th>GL</th>
												<th>Action</th>
											</tr>
										</thead>

                      <tbody>
					<?php
                        $result=$mysqli->custom_select("SELECT student_marks.*, students.studentName, students.classRoll, subject.name as subject_name,term.term FROM `student_marks` JOIN students ON students.id=student_marks.student_id JOIN subject on subject.id=student_marks.subject_id JOIN term on term.id=student_marks.term_id");
					
                        if(!$result['error']){
                            foreach($result['selectdata'] as $i=>$std_marks){
                    ?> 
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $std_marks->term ?></td>
                                <td><?= $std_marks->studentName ?></td>
                                <td><?= $std_marks->classRoll ?></td>
                                <td><?= $std_marks->subject_name ?></td>
                                <td><?= $std_marks->class_name ?></td>
                                <td><?= $std_marks->sub ?></td>
                                <td><?= $std_marks->obj ?></td>
                                <td><?= $std_marks->prac ?></td> 
                                <td><?= $std_marks->total ?></td> 
                                <td><?= $std_marks->gp ?></td> 
                                <td><?= $std_marks->gl ?></td> 
                                <td>
                                    <a onclick="return confirm('Are you sure to delete?')" href="std_marks_delete.php?id=<?= $std_marks->id ?>" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>

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