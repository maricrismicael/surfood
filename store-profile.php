<?php
    session_start();
    
    include("connection.php");  
    include("functions.php");  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
            <div class="logo-box" onclick="openHome()">
                <h1 style="color: #5F5878;">Sur</h1>
                <h1 style="color: #6398C3;">Food</h1>
            </div>
            
            <ul class="nav-links">
                <li><a href="stores.php">Order Now</a></li>
                <li><a href="about.html">Get to Know Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="foodwaste.html">Learn About Food Waste</a></li>
             </ul>
    
            <div class="nav-icons">
                <div class="hamburger">
                    <i class="fa-solid fa-bars" style="color: #b93f80;" onclick="openNav()"></i>
                </div>
            </div>
        </nav>
    
        
        <script>
          function openHome(){
            location.href="index.php";
          }
        </script>

    <?php 
        $store_id = $_GET['storeid'];
        $query = "SELECT * FROM store WHERE store_id = $store_id";

        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_assoc($result)){
          $store_name = $row['store_name'];
          $loc = $row['store_location'];
        }

        echo'
          <section class="store-hero">
          <img src="imgs/banner-'.$store_id.'.png" alt="'.$store_name.' Banner" class="banner">
          <div class="store-details">
              <div class="logo-box"><img src="imgs/logo-'.$store_id.'.png" alt="'.$store_name.' Logo"></div>
              <div class="store-text">
                  <h1>'.$store_name.'</h1>
                  <div><i class="fa-solid fa-location-dot"></i></div>
                  <h4>'.$loc.'</h4>
              </div>
          </div>
          <a href="logout.php" class="logout-btn">Log Out</a>
          </section>
        ';
    ?>

    <section class="order-history">
        <h2>Orders</h2>
        <hr>
        <table>
        <tr>
                <th>Order ID</th>
                <th>Order Details</th>

                <th>Item Name</th>
                <th>Customer's Details</th>
                <th>Total Price</th>
                <th>Data & Time</th>
                <th>Status</th>
            </tr>
            <?php 
              $query = "SELECT * FROM `order_list` WHERE store_id = $store_id ORDER BY date_time DESC";
              $result = mysqli_query($con, $query);

              while($row = mysqli_fetch_assoc($result)){
                $order_id = $row['order_id'];
                $mop = $row['mode_of_payment'];
                $mod = $row['mode_of_delivery'];
                $ptc = $row['person_to_contact'];
                $ptc_phone = $row['ptc_phone'];
                $ptc_address = $row['ptc_address'];
                $total_price = $row['total_price'];
                $date = $row['date_time'];
                $status = $row['status'];

                echo '
                <tr>
                <td>'.$order_id.'</td>
                <td>'.$mod.'<br>'.$mop.'</td>';

                
                $items = "";
                $query = "SELECT * FROM `order_details` INNER JOIN product ON order_details.product_id = product.product_id WHERE order_id='$order_id'";
                $result1 = mysqli_query($con, $query);
                  while($row1 = mysqli_fetch_assoc($result1)){
                    $product = $row1['product_name'];
                    $quantity = $row1['quantity'];
                    $items = $items . $product . ' ('.$quantity.')' . '<br>';
                  }

                echo'
                <td>'.$items.'</td>
                <td>'.$ptc.'<br>'.$ptc_phone.'<br>'.$ptc_address.'</td>
                <td>PHP '.$total_price.'</td>
                <td>'.$date.'</td>
                <td>'.$status.'</td>
                <tr>
                ';
              }

            ?>
            
        </table>
    </section>
    
    <section class="products">
      <h2>Products</h2>
      <hr>
      <div class="menu-products">
        <?php
          $query = "SELECT * FROM `product`WHERE store_id = $store_id";
          $result = mysqli_query($con, $query);
          while($row = mysqli_fetch_assoc($result)){
              $prod_id = $row['product_id'];
              $prod_name = $row['product_name'];
              $prod_time = $row['product_time'];
              $prod_price = $row['product_price'];
              $prod_desc = $row['product_description'];
              $expiration = $row['expiry_date'];

              echo '
            
              <div class="product-card">
                <div class="img-container"><img src="imgs/product-'.$prod_id.'.png" alt="'.$prod_id.' Picture"></div>
                
                <div class="title-hour">
                    <h4>'.$prod_name.'</h4>
                    <h5>Available Until: '.$prod_time.'</h5>
                </div>
                <div class="link">
                  <a href="#">Edit</a>
                  <a href="#">Remove</a>
                </div>
                <h3>PHP '.$prod_price.'</h3>
                <p>'.$prod_desc.'</p>
                <h6>Expiration Date: '.$expiration.'</h6>
            </div>';
          }
        ?>
      </div>
    </section>

    <footer>
      <div class="footer-content">

        <div class="logo-container">
          <div class="logo-box">
            <h1 style="color: white;">Sur</h1>
            <h1 style="color: #6398C3;">Food</h1>
         </div>
          <h3>Excess Resources Give <br> Endless Possibilities</h3>
        </div>

        <div class="footer-row">
          <ul>
            <li class="contact">
              <h3>CONTACT</h3>
              <div class="container">
                <div class="contact-row">
                  <div><i class="fa-solid fa-location-dot"></i></div>
                  <p>Manila City, Philippines</p>
                </div>
                <div class="contact-row">
                  <div><i class="fa-solid fa-phone"></i></div>
                  <p>(042) 123-456</p>
                </div>
                <div class="contact-row">
                  <div><i class="fa-solid fa-envelope"></i></div>
                  <p>surfoodshop@gmail.com</p>
                </div>
              </div>
            </li>

            <li class="follow">
              <h3>FOLLOW US</h3>
              <div class="icons">
                <div><i class="fa-brands fa-twitter"></i></div>
                <div><i class="fa-brands fa-instagram"></i></div>
                <div><i class="fa-brands fa-facebook-f"></i></div>
              </div>
            </li>

          </ul>
        </div>

      </div>
      
      <div class="copyright">
        <h3>Copyright © 2023  SurFood. All rights reserved</h3>
      </div>
    </footer>
  
</body>
</html>