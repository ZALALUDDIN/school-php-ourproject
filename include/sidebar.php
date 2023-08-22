<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
	  <a href="index.html" class="site_title"><i class="fa-solid fa-building-columns"></i> <span>IMS</span></a>
	</div>

	<div class="clearfix"></div>

	<!-- menu profile quick info -->
	<div class="profile clearfix">
		<div class="profile_pic">
            <img src="images/nasim.jpg" alt="..." class="img-circle profile_img">
        </div>
	  <div class="profile_info">
		<span>Welcome,</span>
		<h2><?= $_SESSION['name']; ?></h2>
	  </div>
	</div>
	<!-- /menu profile quick info -->

	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	  <div class="menu_section">
		<h3>Admin</h3>
		<ul class="nav side-menu">
		  <li><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
		  <li><a><i class="fa-solid fa-chalkboard-user"></i> Teacher <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="teacher_list.php">Teacher List</a></li>
					<li><a href="teacher_create.php">Create Teacher</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa-solid fa-chalkboard-user"></i> Fees Category <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="fees_category_list.php"> Fees</a></li>
					<li><a href="fees_category_create.php">Add fees</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa fa-edit"></i> Subject <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="subject_list.php">Subject List</a></li>
					<li><a href="subject_create.php">Create Subject</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa fa-edit"></i> Student <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="student_list.php">Student List</a></li>
					<li><a href="student_create.php">Add Student</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa fa-edit"></i> Student Marks <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="std_marks.php">Mark List</a></li>
					<li><a href="std_marks_create.php">Add Mark</a></li>
					<li><a href="std_mark_sheet.php">Mark Sheet</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa fa-edit"></i> Exam Term <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="term_list.php">List</a></li>
					<li><a href="term_create.php">Add Term</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa fa-edit"></i> Activities <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="activities_list.php">Activities List</a></li>
					<li><a href="activities_create.php">Add Activities</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa fa-money"></i> Student Fees <span class="fa fa-chevron-down"></span></a>
		  		<ul class="nav child_menu">
					<li><a href="stu_fee_list.php">Fees List</a></li>
					<li><a href="stu_fee_create.php">Create Fees</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa fa-table"></i> Group <span class="fa fa-chevron-down"></span></a>
		  		<ul class="nav child_menu">
					<li><a href="groups_list.php">Group List</a></li>
					<li><a href="groups_create.php">Create Group</a></li>
				</ul>
		  </li>
		  <li><a><i class="fa fa-list"></i> Class Routine <span class="fa fa-chevron-down"></span></a>
		  		<ul class="nav child_menu">
					<li><a href="class_routine_show.php"> Class Routine Print</a></li>
					<li><a href="class_routine_view.php"> Class Routine View</a></li>
					<li><a href="create_routine.php">Create Class Routine</a></li>
				</ul>
		  </li>
		</ul>
	  </div>

	</div>
	<!-- /sidebar menu -->

	<!-- /menu footer buttons -->
	<div class="sidebar-footer hidden-small">
	  <a data-toggle="tooltip" data-placement="top" title="Settings">
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
		<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Lock">
		<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	  </a>
	</div>
	<!-- /menu footer buttons -->
  </div>
</div>