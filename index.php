<?php
    session_start();
    
    include("connection.php");  
    include("functions.php");  

    $user_data = check_login($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SurFood</title>
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

    <section class="home-hero">
      <div class="container">
        <div class="cont">
          <h1>Excess Resources Give <br> Endless Possibilities</h1>
          <div class="search">
            <input type="text" name="loc" id="home-loc" placeholder="Enter City">
            <button>Surf Now</button>
          </div>
        </div>
      </div>
    </section>

    <section class="featured">
      <h2>Featured Stores</h2>
      <hr>
      <div class="home-stores-container">

        <!-- Fetch all the restaurants and use a loop to iterate through restaurants -->
        <?php 
          $query = "SELECT * FROM `store` limit 6"; 
          $result = mysqli_query($con, $query);
          while($row = mysqli_fetch_assoc($result)){
            $id = $row['store_id'];
            $store = $row['store_name'];
            $desc = $row['store_description'];


            echo '<div class="store-card">
                    <img src="imgs/store-'.$id.'.png" alt="'.$store.' Logo">
                    <div class="store-details">
                      <h3>'.$store.'</h3>
                      <p>'.substr($desc, 0, 90).'...</p>
                      <a href="menu.php?storeid='.$id.'">Menu</a>
                    </div>
                  </div>';
          }
        ?>
      </div>
    </section>

    <section class="why-surfood">
      <h2>Why SurFood?</h2>
      <hr>
      <div class="container">
        <div class="why-card">
          <img src="imgs/food-waste.jpg" alt="">
          <h3>Help Reduce Food Waste</h3>
          <p>Through SurFood businesses can minimize the amount of food waste they produce by allowing people to avail their surplus goods at a much lower price.</p>
        </div>

        <div class="why-card">
          <img src="imgs/discount.png" alt="">
          <h3>20% Off</h3>
          <p>Stores of partnered companies of SurFood nationwide, will be available in the website in which consumers can purchase products that are 20% less than its original price.</p>
        </div>

        <div class="why-card">
          <img src="imgs/choices.jpg" alt="">
          <h3>Variety of Choices</h3>
          <p>SurFood offers a wide range of choices. We feature different food stores nationwide, ensuring that users can find options that align with their specific needs and desires.</p>
        </div>
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

