
<?php include('partials/menu.php')?> 

  <!-- Main Content Section Starts -->
  <div class="main-content">
    <div class="wrapper">
      <h1>DASHBOARD</h1>
      <br><br>

      <h2>Welcome, <?php echo $_SESSION['user'] ?>!</h2>

      <?php  
      //checking the session is set or not
        if(isset($_SESSION['login'])){
          echo $_SESSION['login']; //displaying session massage if set
          unset($_SESSION['login']); //removing session message
        }
        
        function rows($table,$conn) {
          $sql = "SELECT * FROM $table";
          $res = mysqli_query($conn,$sql);
          $count = mysqli_num_rows($res);
          return $count;
        }

        $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        $total_revenue = $row['Total'];
        
      ?>

      <div class="col-4 text-center">
        <h1><?=rows("tbl_category",$conn)?></h1>
        <br>
        Categories
      </div>

      <div class="col-4 text-center">
        <h1><?=rows("tbl_food",$conn)?></h1>
        <br>
        Foods
      </div>

      <div class="col-4 text-center">
        <h1><?=rows("tbl_order",$conn) ?></h1>
        <br>
        Total Orders
      </div>

      <div class="col-4 text-center">
        <h1>$<?=$total_revenue ?></h1>
        <br>
        Revenue Generated
      </div>

      <div class="clearfix"></div>

    </div>
  </div>
  <!-- Main Content Section Ends --> 


  <?php include('partials/footer.php')?> 