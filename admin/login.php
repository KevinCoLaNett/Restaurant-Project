<?php  include('../config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/admin.css">
  <title>Login - Food Order System</title>
</head>
<body>

  <div class="login">
    <h1 class="text-center">Login</h1><br><br>

    <?php  
      //checking the session is set or not
      if(isset($_SESSION['login'])){
        echo $_SESSION['login']; //displaying session massage if set
        unset($_SESSION['login']); //removing session message
      }
      
      if(isset($_SESSION['no-login-message'])){
        echo $_SESSION['no-login-message']; //displaying session massage if set
        unset($_SESSION['no-login-message']); //removing session message
      }
      
    ?>

    <!--  Login Forn Starts Here  -->
    <form action="" method="POST" class="text-center">
      Username: <br>
      <input type="text" name="username" placeholder="Enter Username" required><br><br>

      Password: <br>
      <input type="password" name="password" placeholder="Enter Password" required><br><br>

      <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
    </form>
    <!--  Login Forn Ends Here  -->
    
    <p class="text-center">Create By - <a href="https://github.com/KevinCoLaNett">John Kevin</a></p>
  </div>
  
</body>
</html>

<?php
  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);
  
    if($res==TRUE){
      $count = mysqli_num_rows($res);
      if($count==1){
        $_SESSION['login'] = "<div class='success'>Login Successful.</div><br><br>";
        $_SESSION['user'] = $username;
        header('location:'.SITEURL.'admin/');
      }
      else{
        $_SESSION['login'] = "<div class='error text-center'> Username or Password is not match.</div><br><br>";
        header('location:'.SITEURL.'admin/login.php');
      }
    }
    else{
      echo "Something is Wrong.";
    }

  }
  

?>