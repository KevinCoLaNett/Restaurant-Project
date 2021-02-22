<?php include('partials/menu.php')?>

  <div class="main-content">
  <div class="wrapper">
    <h1>Change Password</h1>
    
    <br>

    <?php 
      $id = $_GET['id'];


    ?>

    <form action="" method="POST">
      <table class="tbl-40">
        <tr>
          <td>Current Password: </td>
          <td>
            <input type="password" name="current_password" placeholder="Current Password" required>
          </td>
        </tr>

        <tr>
          <td>New Password: </td>
          <td>
            <input type="password" name="new_password" placeholder="New Password" required>
          </td>
        </tr>

        <tr>
          <td>Confirm Password: </td>
          <td>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Change Paswword" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>

  </div>
  </div>

<?php
  if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
      $count = mysqli_num_rows($res);
      if($count==1){
        if($new_password==$confirm_password){
          $sql2 = "UPDATE tbl_admin SET password = '$new_password' WHERE id=$id";
          $res2 = mysqli_query($conn,$sql2);
          if($res2==TRUE){
            $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/manage-admin.php');
          }
          else {
            $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Paswword. </div>";
            //redirect page to add admin
           header("location:".SITEURL.'admin/manage-admin.php');
          }
        }
        else{
          $_SESSION['pwd-not-match'] = "<div class='error'>New Password Did not Match. </div>";
          //redirect page to add admin
         header("location:".SITEURL.'admin/manage-admin.php');
        }
      }
      else{
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found or Incorrect Password. </div>";
        //redirect page to add admin
        header("location:".SITEURL.'admin/manage-admin.php');
      }
    }
    else {
      echo "something is wrong";
    }
  
  }

?>

<?php include('partials/footer.php')?>