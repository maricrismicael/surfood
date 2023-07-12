<?php
    session_start();
    
    include("connection.php");  
    include("functions.php");  

    $user_data = check_login($con);

    if(isset($_SESSION['user_id'])){
        $_SESSION['isModal'] = 0;
        $prod_id = $_GET['prodid'];
        $user_id = $user_data['user_id'];
        

        $query = "SELECT * FROM product WHERE product_id='$prod_id' ";
        $result3 = mysqli_query($con, $query);
        $row3 = mysqli_fetch_assoc($result3);

        $store_id_selected = $row3['store_id'];

        $query = "SELECT * FROM cart INNER JOIN product ON cart.product_id = product.product_id WHERE user_id='$user_id' LIMIT 1";
        $result2 = mysqli_query($con, $query);
        
        $store_id_cart = 0;
        if(mysqli_num_rows($result2)!==0){
            $row2 = mysqli_fetch_assoc($result2);
            $store_id_cart = $row2['store_id'];
        }
        
        echo 'here1';
        
        $query = "SELECT store_id FROM product WHERE product_id='$prod_id'";
        $result1 = mysqli_query($con, $query);

        $row = mysqli_fetch_assoc($result1);
        $store_id = $row['store_id'];

        if($store_id_selected === $store_id_cart || $store_id_cart===0){
            echo 'here2';
            $query = "SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$prod_id' ";
            $result = mysqli_query($con, $query);
    
            if(mysqli_num_rows($result)===0){
                echo 'here3';
                $quantity = 1;
                $query = "INSERT INTO cart (user_id,product_id,quantity) VALUES ('$user_id', '$prod_id', '$quantity') ";
                mysqli_query($con, $query);
                $_SESSION["allow"] = 0;
                header("Location:menu.php?storeid=$store_id");
                die;
            }
            else{
                echo 'here4';
                $row1 = mysqli_fetch_assoc($result);
                $quantity = $row1['quantity'];
                $newquantity = $quantity + 1;
    
                $query = "UPDATE cart SET quantity='$newquantity' WHERE user_id='$user_id' AND product_id='$prod_id'  ";
                mysqli_query($con, $query);
                $_SESSION["allow"] = 0;
                header("Location:menu.php?storeid=$store_id");
                die;
            }

        }
        else{
            $prod_id2 = $_GET['prodid'];
            $_SESSION['isModal'] = 1;
            $_SESSION['prod_id1'] = $prod_id2;
            $_SESSION["allow"] = 0;
            header("Location:menu.php?storeid=$store_id");
            die;
        }


    }
    else{
        header("Location:signin.php");
        die;
    }
    