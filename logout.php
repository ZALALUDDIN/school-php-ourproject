<?php include_once("include/connection.php"); ?>
<?php
    session_destroy();
    echo "<script> location.replace('$base_url/login.php')</script>";
?>