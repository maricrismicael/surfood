<?php
    session_start();
    
    include("connection.php");  
    include("functions.php");  
    
    $user_data = check_login($con);
    $user_id = $user_data['user_id'];

    $query = "DELETE FROM cart WHERE user_id = $user_id";
    $result = mysqli_query($con, $query);

    header("Location:cart.php");
    die;

