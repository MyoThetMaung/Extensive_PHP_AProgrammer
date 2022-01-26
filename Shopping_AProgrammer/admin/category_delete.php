<?php
    session_start();
    require "../config/config.php";

    $id = $_GET['id'];
    $statement = $pdo->prepare("DELETE FROM categories WHERE id=$id");
    $statement->execute();

   header('Location: category.php'); 
