
<?php include('partials/menu.php')?> 

<!-- Main Content Section Starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Category</h1>

    <br>

    <?php 
      
      if(isset($_SESSION['add'])){
        echo $_SESSION['add']; //displaying session massage if set
        unset($_SESSION['add']); //removing session message
      }
      
    ?>

    <br><br>
      
    <!--  Button to Add Category  -->
    <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
      
    <br><br>

    <table class="tbl-full">
        <tr>
          <th>S.N</th> <!-- Serial Number -->
          <th>Title</th>
          <th>Image Name</th>
          <th>Featured</th>
          <th>Active</th>
          <th>Action</th>
        </tr>

        <?php
          //query to get all admin
          $sql = "SELECT * FROM tbl_category";
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
                $image_name = $rows['image_name'];
                $featured = $rows['featured'];
                $active = $rows['active'];

                //display the values in our table
        ?>

                <tr>
                  <td><?php echo $sn++?></td>
                  <td><?php echo $title?></td>

                  <td>
                    <?php 
                      if($image_name!=""){
                        ?>
                        <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" alt="image" width="70px">
                        <?php
                      }
                      else{
                        echo "<div class='error'>Image Not Added</div>";
                      }
                    ?>
                  </td>

                  <td><?php echo $featured?></td>
                  <td><?php echo $active?></td>
                  <td>
                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                  </td>
                </tr>

        <?php
              }
            }
            else{

              ?>
              
                <td>
                  <tr colspan="6"><div class="error">No Category Added</div></tr>
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