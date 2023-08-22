<?php
    include_once("include/connection.php");
    $where['id']=$_GET['id'];
    $result=$mysqli->common_delete('routine',$where);
    if($result['error']){
        $_SESSION['class']="danger";
        $_SESSION['msg']=$result['error'];
    }else{
        $_SESSION['class']="success";
        $_SESSION['msg']="Data Deleted";
    }
    echo "<script> location.replace('$base_url/class_routine_view.php')</script>";
?>