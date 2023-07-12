<?php

session_start();


if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
}

if(isset($_SESSION['store_id'])){
    unset($_SESSION['store_id']);
}

header("Location:index.php");
die;