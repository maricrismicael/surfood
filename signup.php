<?php
    session_start();
    
    include("connection.php");  
    include("functions.php"); 
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);

        if(!empty($fname) && !empty($lname) && !empty($phone) && !empty($email) && !empty($address) && !empty($password)){


            
            $query = "SELECT * FROM user WHERE email='$email'";
            $result = mysqli_query($con, $query);

            if(mysqli_num_rows($result)===0){

                $query = "insert into user (email,first_name,last_name,phone_number,address,password) values('$email','$fname','$lname','$phone','$address','$hashed_password')";
                mysqli_query($con, $query);
    
                header("Location:signin.php");
                die;

            }
            else{
                echo "Email is already taken.";
            }
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

            <h2>Register Now</h2>

            <div class="sign-in-content">

            <form id="sign-up-form" method="post">
                
                <h5 id="notif-signup"></h5>

                <label for="fname" id="fname-label">FIRST NAME
                    <input
                    id="fname-signup"
                    name="fname"
                    type="text"
                    placeholder="Enter your first name"
                    required>
                    </input>
                </label>

                <label for="lname" id="lname-label">LAST NAME
                    <input
                    id="lname-signup"
                    name="lname"
                    type="text"
                    placeholder="Enter your last name"
                    required>
                    </input>
                </label>

                <label for="email" id="email-label">EMAIL
                    <input
                    id="email-signup"
                    name="email"
                    type="email"
                    placeholder="Enter your email"
                    required>
                    </input>
                </label>

                <label for="phone" id="phone-label">PHONE
                    <input
                    id="phone-signup"
                    name="phone"
                    type="text"
                    placeholder="Enter your phone number"
                    required>
                    </input>
                </label>
                
                <label for="address" id="address-label">ADDRESS
                    <input
                    id="address-signup"
                    name="address"
                    type="text"
                    placeholder="Enter your address"
                    required>
                    </input>
                </label>

                <label for="password" id="password-signup-label">PASSWORD
                    <input
                    id="password-signup"
                    name="password"
                    type="password"
                    placeholder="*******"
                    required>
                    </input>
                </label>

                <label for="confirm-password" id="confirm-password-signup-label"> CONFIRM PASSWORD
                    <input
                    id="confirm-password-signup"
                    name="confirm-password"
                    type="password"
                    placeholder="*******"
                    required>
                    </input>
                </label>
            </form>

            <div class="sign-in-button-container">
            <button class="sign-in-button" id="sign-up-btn" onclick="signUp()">Sign Up</button>
            </div>

            <div class="sign-up">
            <h5>Already have an account?  <a href="signin.php">Sign In</a></h5>
            </div>
            </div>
            
        </div>

    </div>

    </section>

    <script>
        function signUp(){
            var notif = document.getElementById("notif-signup");
            var fname = document.getElementById("fname-signup");
            var lname = document.getElementById("lname-signup");
            var email = document.getElementById("email-signup");
            var phone = document.getElementById("phone-signup");
            var address = document.getElementById("address-signup");
            var pass = document.getElementById("password-signup");
            var confirmPass = document.getElementById("confirm-password-signup");
            var form = document.getElementById("sign-up-form");


            if(fname.value=="" || lname.value=="" || email.value=="" || phone.value=="" || address.value=="" || pass.value=="" || confirmPass.value==""){
                notif.innerHTML="Please completely fill up the form.";
            }
            else{

                if(pass.value != confirmPass.value){
                    notif.innerHTML="Passwords do not match.";
                }
                else{

                    if(pass.value.length < 6){
                        notif.innerHTML="Password is too short.";
                    }
                    else{
                       form.submit(); 
                    }
                    
                }
            }
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

