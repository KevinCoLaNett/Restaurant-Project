<?php include('partials/menu.php')?>


<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>

    <br>

    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Full Name: </td>
          <td><input type="text" name="full_name" placeholder="Enter Your Name" required></td>
        </tr>

        <tr>
          <td>Username: </td>
          <td><input type="text" name="username" placeholder="Your Username" required></td>
        </tr>

        <tr>
          <td>Password: </td>
          <td><input type="password" name="password" placeholder="Your Password" required></td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php include('partials/footer.php')?>


<?php
    //Process the value from Form and Save it in Database
    //Check Whether the submit button is clicked or not


    // button clicked
    if(isset($_POST['submit'])){
      
      // Get the Data Value from Form
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];
      $password = md5($_POST['password']); // password enctription with MD5
      

      // SQL Query to save the data to database
      $sql = "INSERT INTO tbl_admin SET
          full_name = '$full_name',
          username = '$username',
          password = '$password'
      ";

      // executing query and saving data in database
      $res = mysqli_query($conn, $sql) or die(mysqli_error());

      //check whether the (query is executed) data is inserted or not and display appropriate message
      if($res==TRUE) {
        //create session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully. </div>";
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
      }
      else {
        //create session variable to display message
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin. </div>";
        //redirect page to add admin
        header("location:".SITEURL.'admin/add-admin.php');
      }
    }
   
?>