<?php include('partials/menu.php')?>

  <div class="main-content">
    <div class="wrapper">
      <h1>Update Food</h1>

      <br>

      <?php 

        if(isset($_GET['id']))
        {
          $id = $_GET['id'];

          $sql = "SELECT * FROM tbl_food WHERE id=$id";
          $res = mysqli_query($conn,$sql);

          if($res==TRUE)
          {

            $count = mysqli_num_rows($res);

            if($count==1)
            {

              $row = mysqli_fetch_assoc($res);
              $title = $row['title'];
              $description = $row['description'];
              $price = $row['price'];
              $current_image = $row['image_name'];
              $current_category = $row['category_id'];
              $featured = $row['featured'];
              $active = $row['active'];

            }
            else 
            {
              $_SESSION['update'] = "<div class='error'>Food not Found.</div>";
              header('location:' . SITEURL.'admin/manage-food.php');
              die();
            }
          }

        }
        else
        {
          $_SESSION['update'] = "<div class='error'>Unauthorized Access!</div>";
          header('location:' . SITEURL.'admin/manage-food.php');
          die();
        }
        
      ?>

      <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-40">
          <tr>
            <td>Title: </td>
            <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
          </tr>

          <tr>
            <td>Description: </td>
            <td><textarea name="description" cols="22" rows="5" ><?php echo $description; ?></textarea></td>
          </tr>

          <tr>
            <td>Price: </td>
            <td><input type="number" name="price" value="<?php echo $price; ?>" required></td>
          </tr>

          <tr>
            <td>Current Image: </td>
            <td>
              <?php 
                if($current_image!="")
                {
              ?>
                  <img src="<?php echo SITEURL; ?>img/food/<?php echo $current_image; ?>" alt="image" width="70px">
              <?php
                }
                else{
                  echo "<div class='error'>Image Not Added</div>";
                }
              ?>
            </td>
          </tr>
          
          <tr>
            <td>New Image: </td>
            <td><input type="file" name="new_image"></td>
          </tr>

          <tr>
            <td>Category: </td>
            <td>
              <select name="category" >
                <?php
                  $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                  $res2 = mysqli_query($conn,$sql2);
                  $count = mysqli_num_rows($res2);
                  if($count>0)
                  {
                    while($row=mysqli_fetch_assoc($res2))
                    {
                      $category_id = $row['id'];
                      $category_title = $row['title'];

                      ?>
                      <option <?php if($current_category==$category_id){echo "Selected"; } ?> value="<?php echo $category_id ?>"><?php echo $category_title ?></option> 
                      <?php
                    }
                  }
                  else{
                    ?>
                      <option value="0">Category Not Available</option>
                    <?php
                  }
                ?>
              </select>
            </td>
          </tr>

          <tr>
            <td>Featured: </td>
            <td>
              <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes" required>Yes
              <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="featured" value="No" required>No
            </td>
          </tr>

          <tr>
            <td>Active: </td>
            <td>
              <input <?php if($active=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes" required>Yes
              <input <?php if($active=="No"){echo "Checked";} ?> type="radio" name="active" value="No" required>No
            </td>
          </tr>

          <tr>
            <td colspan="2">
              <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="submit" name="submit" value="Update Food" class="btn-secondary">
            </td>
          </tr>

        </table>
      </form>

    </div>
  </div>

  <?php

    if(isset($_POST['submit']))
    {
      //get all the value from form to update
      $id = $_POST['id'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $category = $_POST['category'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];
      $current_image = $_POST['current_image'];

      //upload new image only if image is selected
      if(isset($_FILES['new_image']['name']))
      {

        $image_name = $_FILES['new_image']['name'];

        if($image_name!="")
        {
          //auto rename image
          //get extension of image
          $ext = end(explode('.', $image_name));
          //rename image
          $image_name = "Food_Name_".rand(000,999).'.'.$ext;

          $source_path = $_FILES['new_image']['tmp_name'];
          $destination_path = "../img/food/".$image_name;

          $upload = move_uploaded_file($source_path, $destination_path);

          //check whether the image is uploaded or not
          if($upload==FALSE)
          {
            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
            header('location:'.SITEURL.'/admin/manage-food.php');
            die();
          }

          //remove the current image if available
          if($current_image!="")
          {
            $remove_path = "../img/food/".$current_image;
            $remove = unlink($remove_path);
            if($remove==FALSE)
            {
              $_SESSION['remove'] = "<div class='error'> Failed to Remove Current Category Image. Try Again Later. </div>";
              header('location:' .SITEURL.'admin/manage-food.php');
              die();
            }
          }

        }
        else
        {
          $image_name = $current_image;
        }
      }
      else
      {
        $image_name = $current_image;
      }

      $sql3 = "UPDATE tbl_food SET 
        title = '$title',
        description = '$description',
        image_name = '$image_name',
        price = $price,
        category_id = $category,
        featured = '$featured',
        active = '$active'
        WHERE id=$id
      ";

      $res3 = mysqli_query($conn, $sql3);

      if($res3==TRUE)
      {
        $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
        header('location:' . SITEURL.'admin/manage-food.php');
      }
      else
      {
        $_SESSION['update'] = "<div class='error'> Failed to Update Food</div>";
        header('location:' . SITEURL.'admin/manage-food.php');
        die();
      }
    }


  ?>




<?php include('partials/footer.php')?>