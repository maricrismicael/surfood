<?php
    session_start();
    include("connection.php");  
    include("functions.php"); 

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];

      if(!empty($email) && !empty($password)){
        $query = "select * from seller where email = '$email' limit 1";     
        $result = mysqli_query($con, $query);

        if($result){

            if($result && mysqli_num_rows($result)>0){
              $user_data = mysqli_fetch_assoc($result);
              
              if(password_verify($password,$user_data['password'])){
                
                $_SESSION['store_id'] = $user_data['store_id'];
                $id = $user_data['store_id'];
                header("Location: store-profile.php?storeid=$id");
                die;
              }
              else{
                echo "Please enter some valid information.";
              }

            }

        }

        echo "Please enter some valid information.";

      }
      else{
         echo "Please enter some valid information.";
      }
     
    }
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
    
        <section class="sign-in-section">
    
            <div class="sign-in-right">
    
                <div class="sign-in-card">
    
                    <h2>Seller Account Sign In</h2>
    
                    <div class="sign-in-content">
    
                    <form id="sign-in-form" method="post">
                    <label for="email" id="email-label">EMAIL
                        <input
                        id="email"
                        type="text"
                        name="email"
                        placeholder="Enter your email"
                        required>
                        </input>
                    </label>
    
                    <label for="password" id="password-label">PASSWORD
                        <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="*******"
                        required>
                        </input>
                    </label>
                    </form>
    
                    <div class="sign-in-button-container">
                    <button class="sign-in-button" onclick="signIn()">Sign In</button>
                    </div>
    
                    <div class="sign-up">
                    <h5><a href="signin.php">Sign In</a> as Buyer Instead.</h5>
                    </div>
                    </div>
                    
                </div>
    
            </div>
    
        </section>
    
        <script>
          function signIn(){
            var form = document.getElementById('sign-in-form');
            form.submit();
          }
        </script>
    
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
    
    