<?php
  include('../config/constants.php');

  //check whether the id and image_name value is set or not
  if(isset($_GET['id']) && isset($_GET['image_name']))
  {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file if available
    if($image_name!="")
    {
      $path = "../img/category/".$image_name;
      $remove = unlink($path);
      
      if($remove==FALSE)
      {
        $_SESSION['remove'] = "<div class='error'> Failed to Remove Category Image. Try Again Later. </div>";
        header('location:' .SITEURL.'admin/manage-category.php');
        die();
      }
    }

    //delete data from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    //check if executed successfully
    if($res==TRUE)
    {
      $_SESSION['delete'] = "<div class='success'> Category Deleted Successfully. </div>";
      header('location:' .SITEURL.'admin/manage-category.php');
    }
    else
    {
      $_SESSION['delete'] = "<div class='error'> Failed to Delete Category. Try Again Later. </div>";
      header('location:' .SITEURL.'admin/manage-category.php');
      die();
    }

  }
  else
  {
    $_SESSION['delete'] = "<div class='error'>Unauthorized Access!</div>";
    header('location:' .SITEURL.'admin/manage-category.php');
    die();
  }


?>