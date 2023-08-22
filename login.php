<?php include_once("include/connection.php"); ?>
<?php if(isset($_SESSION['id'])) header('location:index.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>School | Round 50 GROUP B</title>

    <!-- Bootstrap -->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
			<?php include('message.php'); ?>
            <form method="post" action="">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="userName" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <button class="btn btn-primary submit" type="submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>
            </form>
			<?php
				if($_POST){
				  $_POST['password']=md5(sha1($_POST['password']));

				  $result=$mysqli->common_select_single('auth','*',$_POST);
				  if($result['error']){
					$_SESSION['class']="danger";
					$_SESSION['msg']="User name or password is wrong";
					echo "<script> location.replace('$base_url/login.php#signin')</script>";
				  }else{
					if($result['selectdata']->status==1){
						$_SESSION['name']=$result['selectdata']->name;
						$_SESSION['email']=$result['selectdata']->email;
						$_SESSION['contact']=$result['selectdata']->contact;
						$_SESSION['id']=$result['selectdata']->id;
						$_SESSION['class']="success";
						$_SESSION['msg']="Login success";
						echo "<script> location.replace('$base_url/index.php')</script>";
					}else{
						$_SESSION['class']="danger";
						$_SESSION['msg']="You are not active user. Please contact to admin";
						echo "<script> location.replace('$base_url/login.php#signin')</script>";
					}
				  }
				}
			  ?>

              <div class="separator">
               
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> ROUND 50 GROUP B</h1>
                  <p>©2022 All Rights Reserved</p>
                </div>
              </div>
			
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
