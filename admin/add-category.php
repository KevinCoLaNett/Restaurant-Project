<?php include('partials/menu.php'); ?>

  <div class="main-content">
    <div class="wrapper">
      <h1>Add Category</h1>

      <br>

      <?php 
      
         if(isset($_SESSION['add'])){
          echo $_SESSION['add']; //displaying session massage if set
          unset($_SESSION['add']); //removing session message
        }
        
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload']; //displaying session massage if set
          unset($_SESSION['upload']); //removing session message
        }
      ?>

      <br><br>

      <!-- Add Category Form Starts Here -->
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">

          <tr>
            <td>Title: </td>
            <td><input type="text" name="title" placeholder="Category Title" required></td>
          </tr>

          <tr>
            <td>Select Image: </td>
            <td><input type="file" name="image"></td>
          </tr>

          <tr>
            <td>Featured: </td>
            <td>
              <input type="radio" name="featured" value="Yes" required>Yes
              <input type="radio" name="featured" value="No" required>No
            </td>
          </tr>

          <tr>
            <td>Active: </td>
            <td>
              <input type="radio" name="active" value="Yes" required>Yes
              <input type="radio" name="active" value="No" required>No
            </td>
          </tr>

          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </td>
          </tr>

        </table>
      </form>
      <!-- Add Category Form Ends Here -->

      <?php

        if(isset($_POST['submit'])) 
        {
          $title = $_POST['title'];
          $featured = $_POST['featured'];
          $active = $_POST['active'];
          $image_name = $_FILES['image']['name'];

          //upload image only if image is selected
          if($image_name!="")
          {
            //auto rename image
            //get extension of image
            $ext = end(explode('.', $image_name));
            //rename image
            $image_name = "Food_Category_".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../img/category/".$image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether the image is uploaded or not
            if($upload==FALSE)
            {
              $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
              header('location:'.SITEURL.'/admin/add-category.php');
              die();
            }
            
          }

          $sql = "INSERT INTO tbl_category SET
              title = '$title',
              image_name = '$image_name',
              featured = '$featured',
              active = '$active'
            ";

          $res = mysqli_query($conn, $sql) or die(mysqli_error());

          if($res==TRUE) {
            //create session variable to display message
            $_SESSION['add'] = "<div class='success'>Category Added Successfully. </div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-category.php');
          }
          else {
            //create session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to Add Category. </div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/add-category.php');
          }
        }

      ?>
       

      </div>
  </div>


<?php include('partials/footer.php'); ?>