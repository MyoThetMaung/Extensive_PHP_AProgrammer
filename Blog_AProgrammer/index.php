<?php
  session_start();
  require "config/config.php";
  require "config/common.php";
  if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
      header("Location: login.php");
  }


  $statement = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
  $statement->execute();
  $result = $statement->fetchAll();

  if(!empty($_GET['page_no'])){
    $page_no = $_GET['page_no'];
    }else{
      $page_no = 1;
    }
    $num_of_record = 5;
    $offset = ($page_no -1) * $num_of_record;
  
    if(empty($_POST['search'])){
      $statement = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
      $statement->execute();
      $raw_result = $statement->fetchAll();
      $total_page = ceil(count($raw_result)/$num_of_record);
    
      $statement = $pdo->prepare("SELECT * FROM posts LIMIT $offset,$num_of_record");
      $statement->execute();
      $result = $statement->fetchAll();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Site</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">


<div class="wrapper">
  <div class="content-wrapper" style="margin-left: 0px !important;">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">    
            <h1 style="text-align: center;">Blog Site</h1>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <?php
          if ($result) {
            foreach ($result as $value) { ?>
              
              <div class="col-md-4">
                <div class="card card-widget">
                  <div class="card-header">
                    <div class="card-title" style=" text-align:center !important; float:none;">
                      <h4><?php echo escape($value['title']); ?></h4>
                    </div>
                  </div>

                    <div class="card-body">
                      <a href="blog_detail.php?id=<?php echo $value['id']; ?>">
                          <img class="img-fluid pad" src="admin/images/<?php echo $value['image']; ?>" style="height: 200px; width: 100%";>  
                      </a>
                    </div>
                  </div>
              </div>
              <?php
              }}
            ?>
          
      </div>
    </section>
    <!-- pagination start -->
    <div class="row" style="float:right;  margin-right:0px;">   
      <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="?page_no=1">First</a></li>
            <li class="page-item <?php if($page_no <= 1){echo 'disabled';} ?>">
                <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{echo '?page_no='.($page_no-1);} ?>">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#"><?php echo $page_no; ?></a></li>
            <li class="page-item <?php if($page_no >= $total_page){echo 'disabled';} ?>">
              <a class="page-link" href="<?php if($page_no >= $total_page){echo '#';}else{echo '?page_no='.($page_no+1);} ?>">Next</a>
            </li>
            <li class="page-item"><a class="page-link" href="?page_no=<?php echo $total_page; ?>">Last</a></li>
          </ul>
      </nav>
    </div> <br><br>
    <!-- pagination end --> 
          

    <!-- footer -->
  <footer class="main-footer" style="margin-left:0px !important">
    <div class="float-right d-none d-sm-block"> 
      <a href="logout.php" type="button" class="btn btn-dark">Logout</a>
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
</div>
</div>





<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
