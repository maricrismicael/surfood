<?php
    session_start();
    
    include("connection.php");  
    include("functions.php");  

    $user_data = check_login($con);
    $fname = $user_data['first_name'];
    $lname = $user_data['last_name'];
    $address = $user_data['address'];
    $phone = $user_data['phone_number'];


    //order
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $mod = $_POST['mod'];
        $mop = $_POST['mop'];
        $ptc = $_POST['person-contact'];
        $address = $_POST['address'];
        $phone = $_POST['contact-number'];

        if(!empty($mod) && !empty($mop) && !empty($ptc) && !empty($address) && !empty($phone) && $_POST['terms'] == 'agree'){
        
        $user_id = $user_data['user_id'];
        $status = "Ongoing"; 
        $order_id = $user_id . getRandomStringRandomInt();

        $total_price = 0;
        $query = "SELECT * FROM `cart` INNER JOIN product ON cart.product_id = product.product_id WHERE user_id = $user_id";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($result)){
          $quantity = $row['quantity'];
          $price = $row['product_price'];
          $subtotal = $price * $quantity; 
          $total_price = $total_price + $subtotal;
          $store_id = $row['store_id'];
        }

        $query = "INSERT INTO order_list (order_id, mode_of_delivery,mode_of_payment,customer_id,status,total_price,person_to_contact,ptc_phone,ptc_address,store_id) VALUES('$order_id','$mod','$mop','$user_id','$status','$total_price','$ptc','$phone','$address','$store_id') ";
        mysqli_query($con, $query);

        $query = "SELECT * FROM `cart` INNER JOIN product ON cart.product_id = product.product_id WHERE user_id = $user_id";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($result)){
          $quantity = $row['quantity'];
          $price = $row['product_price'];
          $prod_id = $row['product_id'];
          $subtotal = $price * $quantity; 
          
          $query = "INSERT INTO order_details (order_id,product_id,quantity,subtotal) VALUES('$order_id','$prod_id','$quantity','$subtotal')";
          mysqli_query($con, $query);
        }

        $query = "DELETE FROM cart WHERE user_id = $user_id";
        $result = mysqli_query($con, $query);
    
        header("Location:customer-profile.php#order-history");
        die;

      }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
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

    <section id="modal">
      <div class="container">
        <h1>Do you want to proceed?</h1>
        <h3>Please make sure that your information are all correct and complete.</h3>
        <div class="btn-container">
          <a onclick="submitOrder()">Yes</a>
          <button onclick="closeModal()">No</button>
        </div>
      </div>
    </section>

    
    <script>
      function submitOrder(){
        var form = document.getElementById('cart-order-details');
        form.submit();
      }

      function closeModal(){
        var modal = document.getElementById('modal');
        modal.style.display = "none";
      }

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
        $user_id = $user_data['user_id'];
        $query = "SELECT * FROM `cart` INNER JOIN product ON cart.product_id = product.product_id WHERE user_id = $user_id";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result)===0){
          echo ' <section class="cart">
                  <img src="imgs/cart.jpg" alt="Cart Banner">
                    <h2>My Cart</h2>
          
                  <div class="store-name">
                      <h3>Empty Cart</h3>
                  </div>
              </section>';

        }
        else{
          $row = mysqli_fetch_assoc($result);
          $firstProd = $row['product_id'];
          $query = "SELECT * FROM `product` INNER JOIN store ON product.store_id = store.store_id WHERE product_id = '$firstProd' LIMIT 1";
          $result1 = mysqli_query($con, $query);
          $row1 = mysqli_fetch_assoc($result1);

          $store_name = $row1['store_name'];
          $store_loc = $row1['store_location'];

          echo '
              <section class="cart">
                  <img src="imgs/cart.jpg" alt="Cart Banner">
                    <h2>My Cart</h2>
                  
                  
                  <div class="empty-cart">
                      <a href="emptyCart.php"><i class="fa-solid fa-xmark"></i></a>
                      <h3>Empty Cart</h3>
                  </div>
          
                  <div class="store-name">
                      <h3>'.$store_name.'</h3>
                      <h4>'.$store_loc.'</h4>
                  </div>
              </section>
              
              <section class="cart-table">
                  <table>
                      ';
                      $total_price = 0;
                      $query = "SELECT * FROM `cart` INNER JOIN product ON cart.product_id = product.product_id WHERE user_id = $user_id";
                      $result2 = mysqli_query($con, $query);
                      while($row2 = mysqli_fetch_assoc($result2)){
                        $quantity = $row2['quantity'];
                        $prod_id = $row2['product_id'];
                        $price = $row2['product_price'];
                        $name = $row2['product_name'];
                        $subtotal = $price * $quantity;
                        $total_price = $total_price + $subtotal;
                        echo'
                        <tr>
                          <td><input type="number" name="item-count" id="'.$prod_id.'" min="0" value='.$quantity.' onchange="changeQuantity(this.id,this.value)"></td>
                          <td><h4>'.$name.'</h4></td>
                          <td><h3>PHP '.$subtotal.'</h3></td>
                         </tr>
                        
                        ';
                      }
            
  

          echo '
          
                  </table>

                  <h3 class="total">Total: PHP '.$total_price.'</h3>
              </section>
          
              <form method="post" id="cart-order-details">
                  <div class="forms">
                  <div class="left">
                      <div class="labels">
                        <label for="person-contact">Person to Contact:</label>
                        <label for="person-contact">Address:</label>
                        <label for="contact-number">Contact Number:</label>
                      </div>
          
                      <div class="inputs">
                        <input type="text" name="person-contact" id="person-contact" value="'.$fname.' '.$lname.'">
                        <input type="text" name="address" id="address-order" value="'.$address.'">
                        <input type="tel" name="contact-number" id="phone-number" value="'.$phone.'">
                      </div>
          
                  </div>
          
                  <div class="right">
                      <div>
                      <label for="mop">Mode of Payment:</label><br>
                      <input type="radio" name="mop" id="cash" value="Cash" checked> <label for="cash" class="radio-label">Cash</label> <br>
                      <input type="radio" name="mop" id="ewallet" value="E-wallet"> <label for="cash" class="radio-label">E-wallet</label> <br>
                      <input type="radio" name="mop" id="debit-credit" value="Debit/Credit Card"> <label for="debit-credit" class="radio-label">Debit/Credit Card</label> <br>
                      </div>
          
                      <div>
                      <label for="mod">Mode of Delivery:</label><br>
                      <input type="radio" name="mod" id="pick-up" value="Pick Up" checked> <label for="pick-up" class="radio-label">Pick Up</label> <br>
                      <input type="radio" name="mod" id="lalamove" value="Lalamove"> <label for="lalamove" class="radio-label">Lalamove</label><br>
                      <input type="radio" name="mod" id="borzo" value="Borzo"> <label for="borzo" class="radio-label">Borzo (Mr. Speedy)</label>
                      </div>
                  </div>
                </div>  
                <div class="terms-conditions">
                  <input type="checkbox" id="terms" name="terms" value="agree">
                  <label for="terms">I agree to the <a href="Surfood_TermsAndConditions.pdf" target ="_blank">terms and conditions</a>.</label><br>
                </div>
                <h5 id="notif-order"></h5>
              </form> 
              <div class="order-btn-container"><button id="order-btn" onclick="placeOrder()">Place Order</button></div>
              
          ';

        }
      
    ?>

        
    
    <script>
      function changeQuantity(id,quantity){
        location.href = "changeQuantity.php?prodid=" + id + "&quantity=" + quantity;
      };

      function placeOrder(){
        var notif = document.getElementById("notif-order");
        var name = document.getElementById("person-contact");
        var phone = document.getElementById("phone-number");
        var address = document.getElementById("address-order");
        var modal = document.getElementById("modal");
        var terms = document.getElementById("terms");

        if(name.value==""  || phone.value=="" || address.value=="" || terms.checked==false){
          notif.innerHTML="Please completely fill up the form.";
        }
        else{
          modal.style.display = "flex";
        }

      };
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