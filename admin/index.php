
<?php include('partials/menu.php')?> 

  <!-- Main Content Section Starts -->
  <div class="main-content">
    <div class="wrapper">
      <h1>DASHBOARD</h1>
      <br><br>

      <?php  
      //checking the session is set or not
        if(isset($_SESSION['login'])){
          echo $_SESSION['login']; //displaying session massage if set
          unset($_SESSION['login']); //removing session message
        }
      ?>

      <div class="col-4 text-center">
        <h1>5</h1>
        <br>
        Categories
      </div>

      <div class="col-4 text-center">
        <h1>5</h1>
        <br>
        Categories
      </div>

      <div class="col-4 text-center">
        <h1>5</h1>
        <br>
        Categories
      </div>

      <div class="col-4 text-center">
        <h1>5</h1>
        <br>
        Categories
      </div>

      <div class="clearfix"></div>

    </div>
  </div>
  <!-- Main Content Section Ends --> 


  <?php include('partials/footer.php')?> 