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
                <h3>Exam Term</h3>
            </div>
        </div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
					<div class="x_title">
						<h2> List </h2>
						<a href="term_create.php" class="btn btn-primary float-right">Add New</a>
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
												<th>Name</th>
												<th>Action</th>
											</tr>
										</thead>

                      <tbody>
					  <?php
                        
                        $result=$mysqli->common_select('term');
                        if(!$result['error']){
                            foreach($result['selectdata'] as $i=>$term){
                    ?> 
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $term->term?></td>
                                <td>
                                    <a href="term_edit.php?id=<?= $term->id ?>" class="btn btn-xs btn-info" title="Update"><i class="fa fa-edit"></i></a>
                                    <a onclick="return confirm('Are you sure to delete?')" href="term_delete.php?id=<?= $term->id ?>" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>

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