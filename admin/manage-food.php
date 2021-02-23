
<?php include('partials/menu.php')?> 

<!-- Main Content Section Starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Food</h1>

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

      if(isset($_SESSION['remove'])){
        echo $_SESSION['remove']; //displaying session massage if set
        unset($_SESSION['remove']); //removing session message
      }

      if(isset($_SESSION['delete'])){
        echo $_SESSION['delete']; //displaying session massage if set
        unset($_SESSION['delete']); //removing session message
      }

      if(isset($_SESSION['update'])){
        echo $_SESSION['update']; //displaying session massage if set
        unset($_SESSION['update']); //removing session message
      }
      
    ?>

    <br><br>
      
      <!--  Button to Add Food  -->
      <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
      
      <br><br>

      <table class="tbl-full">
        <tr>
          <th>S.N</th> <!-- Serial Number -->
          <th>Title</th>
          <!-- <th>Description</th> -->
          <th>Price</th>
          <th>Image Name</th>
          <th>Category</th>
          <th>Featured</th>
          <th>Active</th>
          <th>Action</th>
        </tr>

        <?php
          //query to get all admin
          $sql = "SELECT * FROM tbl_food";
          //execute the query
          $res = mysqli_query($conn, $sql);

          //check whether the query is executed or not
          if($res==TRUE) {
            //count rows to check whether we have data in database or not
            $counts = mysqli_num_rows($res); // function to get all the rows in database

            $sn=1; //create a variable and assign value

            //check the number of rows
            if($counts>0){
              while($rows=mysqli_fetch_assoc($res)){
                //using the while loop to get all the data from database
                //and while loop will run as long as we have data in database

                //get individual data
                $id = $rows['id'];
                $title = $rows['title'];
                $description = $rows['description'];
                $price = $rows['price'];
                $image_name = $rows['image_name'];
                $category_id = $rows['category_id'];
                $featured = $rows['featured'];
                $active = $rows['active'];

                //display the values in our table
        ?>

                <tr>
                  <td><?php echo $sn++;?></td>
                  <td><?php echo $title;?></td>
                  <!-- <td>
                    <?php
                      // if($description!="")
                      // {
                      //   echo $description;
                      // }
                      // else
                      // {
                      //   echo "<div class='error'>No Description Added</div>";
                      // } 
                    ?> 
                  </td> -->
                  <td><?php echo $price;?></td>

                  <td>
                    <?php 
                      if($image_name!=""){
                        ?>
                        <img src="<?php echo SITEURL; ?>img/food/<?php echo $image_name; ?>" alt="image" width="70px">
                        <?php
                      }
                      else{
                        echo "<div class='error'>Image Not Added</div>";
                      }
                    ?>
                  </td>

                  <td>
                    <?php
                      if($category_id!="")
                      {
                         $sql2 = "SELECT * FROM tbl_category WHERE id=$category_id";
                         $res2 = mysqli_query($conn,$sql2);
                         $row=mysqli_fetch_assoc($res2);
                         echo $row['title'];
                      }
                      else
                      {
                        echo "<div class='error'>No Category</div>";
                      } 
                    ?>
                  </td> 
                  <td><?php echo $featured;?></td>
                  <td><?php echo $active;?></td>
                  <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                  </td>
                </tr>

        <?php
              }
            }
            else{

              ?>
              
                <td>
                  <tr colspan="6"><br><div class="error">No Food Added yet</div><br></tr>
                </td>

              <?php
            }
          }
        ?>
      </table>
  </div>
</div>
<!-- Main Content Section Ends --> 


<?php include('partials/footer.php')?> 