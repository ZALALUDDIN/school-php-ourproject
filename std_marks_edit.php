<?php include_once("include/connection.php"); ?>
<?php if(!isset($_SESSION['id'])) header('location:login.php'); ?>
<?php
	$where['student_id']=$_GET['student_id'];
	$where['term_id']=$_GET['term_id'];
	$where['subject_id']=$_GET['subject_id'];
	$result=$mysqli->common_select_single('student_marks','id,sub,obj,prac',$where);
	if(!$result['error']){
		echo json_encode(array('data'=>$result['selectdata']));
	}else{
		echo json_encode(array('data'=>false));
	}
?>