<?php
  session_start();
  require "config/config.php";
  require "config/common.php";
  if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
      header("Location: login.php");
  }

  //getting post
  $statement = $pdo->prepare("SELECT * FROM posts WHERE id=".$_GET['id']);
  $statement->execute();
  $result = $statement->fetchAll();
  
  //getting comment
  $blog_id = $_GET['id'];
  $state_comment = $pdo->prepare("SELECT * FROM comments WHERE post_id=$blog_id");
  $state_comment->execute();
  $result_comment = $state_comment->fetchAll();

  //if comment exits
  $result_author = [];
  if($result_comment){
    foreach ($result_comment as $key => $value) {
        $author_id = $result_comment[$key]['author_id'];
        $state_author = $pdo->prepare("SELECT * FROM users WHERE id=$author_id");
        $state_author->execute();
        $result_author[] = $state_author->fetchAll();
    }
  }

  //posts to db
  if($_POST){
    $comment = $_POST['comment'];
    $author_id = $_SESSION['user_id'];
    $statement = $pdo->prepare("INSERT INTO comments(content,author_id,post_id) VALUES ('$comment','$author_id','$blog_id')");
    $result = $statement->execute();
    if($result){
      header("Location: blog_detail.php?id=".$blog_id);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Detail</title>

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
    <section class="content-header">
      <div class="container-fluid">    
            <h1 style="text-align: center;">Blog Site</h1>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
          <div class="col-md-12">            
            <div class="card-header">
                <div class="card-title" style=" text-align:center !important; float:none;">
                  <h4><?php echo $result[0]['title']; ?></h4>
                </div>
            </div>
            <div class="card-body">
                <!-- <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo"> -->
                <img  class="img-fluid pad" src="admin/images/<?php echo $result[0]['image']; ?>" width="100%" alt="">
                <p><?php echo $result[0]['content']; ?></p>
                <h3>Comments</h3> <hr>
                <a href="index.php" class="btn btn-dark">Go Back</a>
            </div>
              <div class="card-footer card-comments">
                <div class="card-comment" >
                  <?php if($result_comment){ ?>
             
                    <div class="comment-text" style="margin-left:0px !important;">

                    <?php foreach ($result_comment as $key => $value) { ?>
                  
                      <span class="username">
                        <?php echo escape($result_author[$key][0]['name']); ?>
                        <span class="text-muted float-right"><?php echo escape($value['created_at']); ?></span>
                      </span>
                      <?php echo escape($value['content']); ?>

                    <?php } ?>

                    </div>          
                  <?php }?>
                </div>      
              </div>
              <div class="card-footer">
                <form action="" method="POST">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                  <div class="img-push">
                    <input type="text" name="comment" class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
            </div>
          </div>     
        </div>
    </section>
          

    <!-- footer -->
  <footer class="main-footer" style="margin-left:0px !important">
    <div class="float-right d-none d-sm-inline">
      <a href="logout.php" type="button" class="btn btn-dark">Logout</a>
    </div>
    <strong>Copyright &copy; 2022-2023<a href="#">A Programmer</a></strong> All rights reserved.
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
