<?php

session_start();


if(isset($_SESSION['user_id'])){
    header("Location:cart.php");
    die;
}
else{
    header("Location:signin.php");
    die;
}
