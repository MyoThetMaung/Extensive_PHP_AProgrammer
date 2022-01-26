<?php

    session_start();
    require "../config/config.php";
    require "../config/common.php";
    if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
        header("Location: login.php");
    }
    if($_SESSION['role'] != 1 ){
      header('Location: login.php');
    }

    $id = $_GET['id'];  
    if($_POST){
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || strlen($_POST['password']) < 4){
        if(empty($_POST['name'])){
            $name_error = "Name cannot be null";
        }
        if(empty($_POST['email'])){
            $email_error = "Email cannot be null";
        }
        if(empty($_POST['password'])){
            $password_error = "Password cannot be null";
        }
        if(strlen($_POST['password']) < 4){
            $password_error = "Password should be not less than 4 characters";
        }
    }
    else{
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        if(empty($_POST['role'])){
            $role = 0;
        }else{
            $role = 1;
        }
        $statement = $pdo ->prepare("SELECT * FROM users WHERE email='$email' AND id!=$id");
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user){
            echo "<script>alert('Email duplicated !')</script>";
        }else{
            $statement = $pdo ->prepare("UPDATE users SET name='$name', email='$email', role='$role', password='$password' WHERE id=$id");
            $result = $statement->execute();
            if($result){
                echo "<script>alert('Successfully user added!');window.location.href='user_list.php';</script>";
            }
        }
    }
}
    $statement = $pdo ->prepare("SELECT * FROM users WHERE id=$id");
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
 

?>
    <?php include "header.php"; ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                <div class="form-group">
                                    <label for="">Name</label> <p style="color:red;"><?php echo empty($name_error) ? "" : $name_error; ?></p>
                                    <input type="text" name="name" class="form-control" value="<?php echo escape($user['name']);?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>  <p style="color:red;"><?php echo empty($email_error) ? "" : $email_error; ?></p>
                                    <input type="email" name="email" class="form-control" value="<?php echo escape($user['email']);?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Password <small class="text-success">(This user already has password)</small></label> <p style="color:red;"><?php echo empty($password_error) ? "" : $password_error; ?></p>
                                    <input type="text" name="password" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Admin</label> <br>
                                    <input type="checkbox" name="role" value="1" <?php if($user['role']==1){echo "checked";}else{echo "";} ?>>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="UPDATE">
                                    <a href="user_list.php" class="btn btn-warning">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer" style="margin-left:0px;">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <a href="logout.php" type="button" class="btn btn-dark">Logout</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021-2022 <a href="https://adminlte.io">A Programmer</a>.</strong> All rights reserved.
  </footer>