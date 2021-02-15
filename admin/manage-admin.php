
<?php include('partials/menu.php')?> 

  <!-- Main Content Section Starts -->
  <div class="main-content">
    <div class="wrapper">
      <h1>Manage Admin</h1>
      
      <br>
      
      <?php
        //checking the session is set or not
        if(isset($_SESSION['add'])){
          echo $_SESSION['add']; //displaying session massage if set
          unset($_SESSION['add']); //removing session message
        }

        if(isset($_SESSION['delete'])){
          echo $_SESSION['delete']; //displaying session massage if set
          unset($_SESSION['delete']); //removing session message
        }

        if(isset($_SESSION['update'])){
          echo $_SESSION['update']; //displaying session massage if set
          unset($_SESSION['update']); //removing session message
        }

        if(isset($_SESSION['user-not-found'])){
          echo $_SESSION['user-not-found']; //displaying session massage if set
          unset($_SESSION['user-not-found']); //removing session message
        }
        
        if(isset($_SESSION['pwd-not-match'])){
          echo $_SESSION['pwd-not-match']; //displaying session massage if set
          unset($_SESSION['pwd-not-match']); //removing session message
        }

        if(isset($_SESSION['change-pwd'])){
          echo $_SESSION['change-pwd']; //displaying session massage if set
          unset($_SESSION['change-pwd']); //removing session message
        }
      ?>

      <br><br><br>


      <!--  Button to Add Admin  -->
      <a href="add-admin.php" class="btn-primary">Add Admin</a>

      <br><br>

      <table class="tbl-full">
        <tr>
          <th>S.N</th>
          <th>Full Name</th>
          <th>Username</th>
          <th>Action</th>
        </tr>

        <?php
          //query to get all admin
          $sql = "SELECT * FROM tbl_admin";
          //execute the query
          $res = mysqli_query($conn, $sql);

          //check whether the query is executed or not
          if($res==TRUE) {
            //count rows to check whether we have data in database or not
            $rows = mysqli_num_rows($res); // function to get all the rows in database

            $sn=1; //create a variable and assign value

            //check the number of rows
            if($rows>0){
              while($rows=mysqli_fetch_assoc($res)){
                //using the while loop to get all the data from database
                //and while loop will run as long as we have data in database

                //get individual data
                $id=$rows['id'];
                $full_name=$rows['full_name'];
                $username=$rows['username'];

                //display the values in our table
        ?>

                <tr>
                  <td><?php echo $sn++?></td>
                  <td><?php echo $full_name?></td>
                  <td><?php echo $username?></td>
                  <td>
                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Paswword</a>
                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                  </td>
                </tr>

        <?php
              }
            }
            else{
              // we do not have data in database
              echo "No Data in Database";
            }
          }
        ?>
      </table>

    </div>
  </div>
  <!-- Main Content Section Ends --> 


  <?php include('partials/footer.php')?> 