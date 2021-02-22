<?php
  include('../config/constants.php');

    if(isset($_GET['id'])){
      //get the id of admin to be deleted
      $id = $_GET['id'];
    
      //query to delete
      $sql = "DELETE FROM tbl_admin WHERE id=$id";
      $res = mysqli_query($conn,$sql);

     //check if executed successfully
      if($res==TRUE){
        $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully. </div>";
        header('location:' .SITEURL.'admin/manage-admin.php');
      }
      else{
        $_SESSION['delete'] = "<div class='error'> Failed to Delete Admin. Try Again Later. </div>";
        header('location:' .SITEURL.'admin/manage-admin.php');
        die();
      }
    }
    else{
      $_SESSION['delete'] = "<div class='error'>Unauthorized Access!</div>";
      header('location:' .SITEURL.'admin/manage-admin.php');
      die();
    }
    

?>