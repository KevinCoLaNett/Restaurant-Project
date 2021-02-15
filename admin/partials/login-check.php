<?php
  //authorization - access control
  //check the user if logged in or not
  if(!isset($_SESSION['user'])){
    $_SESSION['no-login-message'] = "<div class='error'>Please Login to access Admin Panel</div><br><br>";
    header('location:' .SITEURL.'admin/login.php');
  }

?>