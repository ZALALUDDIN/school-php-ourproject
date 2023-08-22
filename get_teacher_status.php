<?php include_once("include/connection.php"); ?>
<?php if(!isset($_SESSION['id'])) header('location:login.php'); ?>
<?php
	$where['teacher_id']=$_GET['teacher_id'];
	$where['day']=$_GET['day'];
	$where['time']=$_GET['time'];
	$result=$mysqli->common_select_single('routine','id',$where);
	echo $result['numrows'];
?>