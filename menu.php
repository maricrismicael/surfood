<?php
    session_start();
    
    include("connection.php");  
    include("functions.php");  

    $user_data = check_login($con);

    if(ISSET($user_data['user_id'])){
      $user_id = $user_data['user_id'];
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $allow = $_POST['allow-number'];
      $allowProd = $_POST['allow-prod'];

      if($allow==1 && !empty($allowProd)){
          $query = "DELETE FROM cart WHERE user_id = $user_id";
          $result = mysqli_query($con, $query);
      }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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

            <div class="cart-profile">
                <i class="fa-solid fa-cart-shopping" id="nav-cart" style="color: #b93f80;" onclick="openCart()"></i>
                <i class="fa-solid fa-user" id="nav-user" style="color: #576E78;" onclick="openUser()"></i>
            </div>
        </div>
    </nav>

    
    <script>
      function openCart(){
        location.href="openCart.php";
      }

      function openUser(){
        location.href="openUser.php";
      }

      function openHome(){
        location.href="index.php";
      }
    </script>

        
    <?php 

    if(ISSET($_SESSION['isModal']) && ISSET($_SESSION['prod_id1'])){
      $isModal = $_SESSION['isModal'];
      $prodid = $_SESSION['prod_id1'];


      if($isModal === 1){
        echo'
        
        <section id="modal-menu">
        <div class="container">
          <h1>Do you want to empty the cart?</h1>
          <h3>There are other products from another store in your cart, you need to empty the cart before adding a product from another store.</h3>
          <div class="btn-container">
            <a onclick="allow()">Yes</a>
            <button onclick="closeModal()">No</button>
          </div>
        </div>
      </section>

      <form id="form-allow" method="post" hidden>
        <input type="number" id="allow-number" name="allow-number">
        <input type="text"  id="allow-prod" name="allow-prod" value="'.$prodid.'"> 
      </form>
      
      <script>
        function closeModal(){
          var modal = document.getElementById("modal-menu");
          modal.style.display = "none";
        }
        function allow(){
          var input1 = document.getElementById("allow-number");
          var form = document.getElementById("form-allow");

          input1.value = 1;
          form.submit();
        }
      </script>
        
        ';
        $_SESSION['isModal'] = 0;
      }
    }
    ?>

    <?php
        $id = $_GET['storeid'];
        $query = "SELECT * FROM `store`WHERE store_id = $id limit 1";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($result)){
            $storename = $row['store_name'];
            $store_loc = $row['store_location'];
        }

      echo '
            <section class="store-hero">
                <img src="imgs/banner-'.$id.'.png" alt="'.$storename.'Banner" class="banner">
                <div class="store-details">
                    <div class="logo-box"><img src="imgs/logo-'.$id.'.png" alt="'.$storename.' Logo"></div>
                    <div class="store-text">
                        <h1>'.$storename.'</h1>
                        <div><i class="fa-solid fa-location-dot"></i></div>
                        <h4>'.$store_loc.'</h4>
                    </div> 
                </div>
            </section> '
    ?>

    <section class="products">
      <div class="menu-products">


      <?php
        $id = $_GET['storeid'];
        $query = "SELECT * FROM `product`WHERE store_id = $id";
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
              <a href="addToCart.php?prodid='.$prod_id.'">Add to cart</a>
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