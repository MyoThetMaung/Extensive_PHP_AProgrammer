<?php
    session_start();
    require "../config/config.php";

    $id = $_GET['id'];
    $statement = $pdo->prepare("DELETE FROM posts WHERE id=$id");
    $statement->execute();

   header('Location: index.php'); 
