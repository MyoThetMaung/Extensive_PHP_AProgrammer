<?php

    session_start();
    require "config/config.php";

    if($_POST){

        $id = $_POST['id'];
        $quantity = $_POST['quantity'];

        $statement = $pdo->prepare("SELECT * FROM products WHERE id=$id");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($quantity > $result['quantity']){
            echo "<script>alert('not enough stock'); window.location.href='product_detail.php?id=$id';</script>";
        }else{
            if(isset($_SESSION['cart']['id'.$id])){
                $_SESSION['cart']['id'.$id] += $quantity;
            }else{
                $_SESSION['cart']['id'.$id] = $quantity;
            }
            header("Location: cart.php?id=".$id);
        }


    } 