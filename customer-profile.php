<?php
    session_start();
    
    include("connection.php");  
    include("functions.php"); 

    $user_data = check_login($con);
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $user_id = $user_data['user_id'];


        if(!empty($fname) && !empty($lname) && !empty($phone) && !empty($email) && !empty($address)){

            $query = "update user set email='$email', phone_number='$phone', first_name='$fname', last_name='$lname', address='$address' where user_id='$user_id'";
            mysqli_query($con, $query);

            header("Location:customer-profile.php");
            die;
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
    <title>My Profile</title>
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
    

    <section class="edit-section">
        <img src="imgs/account banner.jpg" alt="">

        <h2>My Profile</h2>
        <a href="logout.php" class="logout-btn">Log Out</a>
        <div class="form-container">
          <form id="edit-form" method="post">
            <h3 id="notif-user"></h3>
          <h3>Personal Information</h3>
          <hr>
          
          <div class="form-row">
              <label for="first-name" id="first-name-label">FIRST NAME
                <input
                  id="fnmae-user"
                  name="fname"
                  type="text"
                  value="<?php echo $user_data['first_name']?>"
                  placeholder="Enter Your First Name"
                  required>
                </input>
              </label>
  
              <label for="last-name" id="last-name-label">LAST NAME
                <input
                  id="lname-user"
                  name="lname"
                  type="text"
                  value="<?php echo $user_data['last_name']?>"
                  placeholder="Enter Your Last Name"
                  required>
                </input>
              </label>
          </div>
  
          <h3>Contact Information</h3>
          <hr>
  
          <div class="form-row">
  
                  <label for="phone" id="phone-label">PHONE
                  <input
                      id="phone-user"
                      name="phone"
                      type="text"
                      value="<?php echo $user_data['phone_number']?>"
                      placeholder="Enter Your Phone Number"
                      required>
                  </input>
                  </label>
  
                  <label for="email" id="email-label">EMAIL
                      <input
                          id="email-user"
                          name="email"
                          type="email"
                          value="<?php echo $user_data['email']?>"
                          placeholder="Enter Your Email"
                          required>
                      </input>
                  </label>

          </div>
  
          <h3>Address</h3>
          <hr>
          <div class="form-row">

              <label for="address" id="address-label">ADDRESS
                <input
                  id="address-user"
                  name="address"
                  type="text"
                  value="<?php echo $user_data['address']?>"
                  placeholder="Enter Your Address"
                  required>
                </input>
              </label>
            
  
            <div class="account-button-container">
              <button class="account-save-button" onclick="updateUser()">Save Changes</button>
            </div>
         </div>
      </form>
      </section>

      <script>

        function updateUser(){
            var notif = document.getElementById("notif-user");
            var fname = document.getElementById("fname-user");
            var lname = document.getElementById("lname-user");
            var email = document.getElementById("email-user");
            var phone = document.getElementById("phone-user");
            var address = document.getElementById("address-user");
            var form = document.getElementById("notif-form");


            if(fname.value=="" || lname.value=="" || email.value=="" || phone.value=="" || address.value==""){
              notif.innerHTML="Please completely fill up the form.";
            }
            else{
              form.submit();
            }
        }
      </script>

      <section class="order-history" id="order-history">
        <h2>My Order History</h2>
        <hr>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Order Details</th>
                <th>Store</th>
                <th>Item Name</th>
                <th>Customer's Details</th>
                <th>Total Price</th>
                <th>Data & Time</th>
                <th>Status</th>
            </tr>
            <?php 
              $user_id = $user_data['user_id'];
              $query = "SELECT * FROM `order_list` INNER JOIN store ON order_list.store_id = store.store_id WHERE customer_id = $user_id ORDER BY date_time DESC";
              $result = mysqli_query($con, $query);

              while($row = mysqli_fetch_assoc($result)){
                $order_id = $row['order_id'];
                $mop = $row['mode_of_payment'];
                $mod = $row['mode_of_delivery'];
                $store = $row['store_name'];
                $ptc = $row['person_to_contact'];
                $ptc_phone = $row['ptc_phone'];
                $ptc_address = $row['ptc_address'];
                $total_price = $row['total_price'];
                $date = $row['date_time'];
                $status = $row['status'];

                echo '
                <tr>
                <td>'.$order_id.'</td>
                <td>'.$mod.'<br>'.$mop.'</td>
                <td>'.$store.'</td>';
                
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