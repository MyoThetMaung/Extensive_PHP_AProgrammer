<?php
    session_start();
    require "config/config.php";
    require "config/common.php";

    if($_POST){
      if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || strlen($_POST['password']) < 4){
        if(empty($_POST['name'])){
          $name_error = "Name cannot be null";
        }
        if(empty($_POST['email'])){
          $email_error = "Email cannot be null";
        }
        if(strlen($_POST['password']) < 4){
          $password_error = "Password should be not less than 4 characters";
        }
        if(empty($_POST['password'])){
          $password_error = "Password cannot be null";
        }
        
    }else{
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $password = password_hash($password, PASSWORD_DEFAULT);

      $statement = $pdo->prepare("SELECT * FROM users WHERE email='$email'");
      $statement->execute();
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      if($user){
          echo "<script>alert('email duplicated!');</script>";
      }else{
          $statement = $pdo->prepare("INSERT INTO users(name,email,password,role) VALUES('$name','$email','$password',0)");
          $result = $statement->execute();
          if($result){
              echo "<script>alert('Successfully register! You can now log in');window.location.href='login.php';</script>";
          }
      }
    } 
}
?>  


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog | Register</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Blog</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register Here</p>

      <form action="register.php" method="post">
      <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <p style="color:red;"><?php echo empty($name_error) ? "" : $name_error; ?></p>
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <p style="color:red;"><?php echo empty($email_error) ? "" : $email_error; ?></p>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <p style="color:red;"><?php echo empty($password_error) ? "" : $password_error; ?></p>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="container">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <a href="login.php" class="btn btn-default btn-block">Login</a>
          </div>
        </div>
      </form>
      <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>




