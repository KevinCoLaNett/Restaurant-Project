
<?php include('partials/menu.php')?> 

<!-- Main Content Section Starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Order</h1>

    <br>

    <?php 
      
      if(isset($_SESSION['update'])){
        echo $_SESSION['update']; //displaying session massage if set
        unset($_SESSION['update']); //removing session message
      }

    ?>
      <br><br>
      <!--  Button to Add Food  -->
      <a href="<?php echo SITEURL;?>foods.php" class="btn-primary">Add Order</a>
      <br><br>

      <table class="tbl-full">
        <tr>
          <th>S.N</th>
          <th>Food</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Order Date</th>
          <th>Status</th>
          <th>Customer Name</th>
          <th>Customer Contact</th>
          <th>Email</th>
          <th>Address</th>
          <th>Action</th>
        </tr>

        <?php
          //query to get all admin
          $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
          //execute the query
          $res = mysqli_query($conn, $sql);

          //check whether the query is executed or not
          if($res==TRUE) 
          {
            //count rows to check whether we have data in database or not
            $counts = mysqli_num_rows($res); // function to get all the rows in database

            $sn=1; //create a variable and assign value

            //check the number of rows
            if($counts>0)
            {
              while($row=mysqli_fetch_assoc($res))
              {
                //using the while loop to get all the data from database
                //and while loop will run as long as we have data in database

                //get individual data
                $id = $row['id'];
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
         ?>
            <tr>
              <td><?php echo $sn++?></td>
              <td><?php echo $food?></td>
              <td><?php echo $price?></td>
              <td><?php echo $qty?></td>
              <td><?php echo $total?></td>
              <td><?php echo $order_date?></td>
              <td>
                <?php 
                  if($status=="Ordered")
                  {
                    echo "<label style='color: blue'>$status</label>";
                  }
                  elseif($status=="On Delivery")
                  {
                    echo "<label style='color: orange'>$status</label>";
                  }
                  elseif($status=="Delivered")
                  {
                    echo "<label style='color: green'>$status</label>";
                  }
                  else {
                    echo "<label style='color: red'>$status</label>";
                  }
                ?>
              </td>
              <td><?php echo $customer_name?></td>
              <td><?php echo $customer_contact?></td>
              <td><?php echo $customer_email?></td>
              <td><?php echo $customer_address?></td>
              <td>
                  <a href="<?php echo SITEURL?>admin/update-order.php?id=<?php echo $id?>" class="btn-secondary">Update</a>
              </td>
            </tr>
        <?php
              }
            }
            else
            {
              echo "<tr><td colspan='12' class='error'>No Order</div>";
            }
          } 
        ?>

        
      </table>

  </div>
</div>
<!-- Main Content Section Ends --> 


<?php include('partials/footer.php')?> 