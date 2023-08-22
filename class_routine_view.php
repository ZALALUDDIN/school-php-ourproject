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
                <h3>Routine</h3>
            </div>
        </div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
					<div class="x_title">
						<h2>Routine View </h2>
						<a href="create_routine.php" class="btn btn-primary float-right">Add New</a>
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
												<th>Teacher Name</th>
												<th>Class</th>
												<th>Subject</th>
												<th>Day</th>
												<th>Time</th>
												<th>Action</th>
											</tr>
										</thead>

                      <tbody>
					  <?php
					  	$sql="SELECT routine.*, teacher.teacherName, subject.name as sub FROM `routine` LEFT join teacher on teacher.id=routine.teacher_id LEFT JOIN subject on subject.id=routine.sub_id order by routine.class_name,routine.day,routine.time";
                        $result=$mysqli->custom_select($sql);
                        if(!$result['error']){
                            foreach($result['selectdata'] as $i=>$routine){
                    ?> 
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $routine->teacherName ?></td>
                                <td><?= $routine->class_name ?></td>
                                <td><?= $routine->sub ?></td>
                                <td><?= $routine->day ?></td>
                                <td><?= $routine->time ?></td>
                                <td>
                                    <a href="class_routine_edit.php?id=<?= $routine->id ?>" class="btn btn-xs btn-info" title="Update"><i class="fa fa-edit"></i></a>
                                    <a onclick="return confirm('Are you sure to delete?')" href="class_routine_delete.php?id=<?= $routine->id ?>" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>

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