<?php

session_start();


if(isset($_SESSION['user_id'])){
    header("Location:customer-profile.php");
    die;
}
else{
    header("Location:signin.php");
    die;
}
