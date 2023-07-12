<?php

function check_login($con){

    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];

        $query = "select * from user where user_id ='$id' limit 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    
}

function check_seller_login($con){

    if(isset($_SESSION['store_id'])){
        $id = $_SESSION['store_id'];

        $query = "select * from seller where store_id ='$id' limit 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    
}


function getRandomStringRandomInt($length = 16)
{
    $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pieces = [];
    $max = mb_strlen($stringSpace, '8bit') - 1;
    for ($i = 0; $i < $length; ++ $i) {
        $pieces[] = $stringSpace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
