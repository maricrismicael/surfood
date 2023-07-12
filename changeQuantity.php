<?php
    session_start();
    
    include("connection.php");  
    include("functions.php");  
    
    $user_data = check_login($con);
    $user_id = $user_data['user_id'];

    $prod_id = $_GET['prodid'];
    $quantity = $_GET['quantity'];

    if($quantity==0){
        $query = "DELETE FROM cart WHERE product_id='$prod_id' AND  user_id = $user_id";
        mysqli_query($con, $query);
    }
    else{
        $query = "UPDATE cart SET quantity = $quantity WHERE product_id='$prod_id' AND  user_id = $user_id";
        mysqli_query($con, $query);
    }

    header("Location:cart.php");
    die;
