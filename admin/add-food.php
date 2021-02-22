<?php include('partials/menu.php')?>
  <div class="main-content">
    <div class="wrapper">
      <h1>Add Food</h1>

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

      <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-40">
          <tr>
            <td>Title: </td>
            <td><input type="text" name="title" placeholder="Food Title" required></td>
          </tr>

          <tr>
            <td>Description: </td>
            <td><textarea name="description" cols="22" rows="5" placeholder="Food Description" ></textarea></td>
          </tr>

          <tr>
            <td>Price: </td>
            <td><input type="number" name="price" placeholder="Food Price" required></td>
          </tr>

          <tr>
            <td>Select Image: </td>
            <td><input type="file" name="image"></td>
          </tr>

          <tr>
            <td>Category: </td>
            <td>
              <select name="category" >
                <?php
                  $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                  $res = mysqli_query($conn,$sql);
                  $count = mysqli_num_rows($res);
                  if($count>0)
                  {
                    while($row=mysqli_fetch_assoc($res))
                    {
                      $id = $row['id'];
                      $title = $row['title'];

                      ?>
                      <option value="<?php echo $id ?>"><?php echo $title ?></option> 
                      <?php
                    }
                  }
                  else{
                    ?>
                      <option value="0">No Category Found</option>
                    <?php
                  }
                ?>
              </select>
            </td>
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
              <input type="submit" name="submit" value="Add Food" class="btn-secondary">
            </td>
          </tr>

        </table>
      </form>
    
    </div>
  </div>


  <?php 
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        $image_name = $_FILES['image']['name'];

        if($image_name!="")
          {
            //auto rename image
            //get extension of image
            $ext = end(explode('.', $image_name));
            //rename image
            $image_name = "Food_Name_".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../img/food/".$image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether the image is uploaded or not
            if($upload==FALSE)
            {
              $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
              header('location:'.SITEURL.'/admin/add-food.php');
              die();
            }
            
          }

        $sql2 = "INSERT INTO tbl_food SET
              title = '$title',
              description = '$description',
              image_name = '$image_name',
              price = '$price',
              category_id = '$category_id',
              featured = '$featured',
              active = '$active'
            ";

        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());

        if($res2==TRUE) {
          //create session variable to display message
          $_SESSION['add'] = "<div class='success'>Food Added Successfully. </div>";
          //redirect page to manage admin
          header("location:".SITEURL.'admin/manage-food.php');
        }
        else 
        {
          //create session variable to display message
          $_SESSION['add'] = "<div class='error'>Failed to Add Food. </div>";
          //redirect page to add admin
          header("location:".SITEURL.'admin/add-food.php');
        }
    }
  
  ?>




<?php include('partials/footer.php')?>