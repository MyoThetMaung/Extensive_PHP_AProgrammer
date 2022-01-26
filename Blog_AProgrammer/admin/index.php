
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
?>

  <?php include "header.php"; ?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Blog List</h1>
              </div>
              <?php
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
                  }else{
                    $search_key = $_POST['search'];
                    $statement = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$search_key%' ORDER BY id DESC");
                    $statement->execute();
                    $raw_result = $statement->fetchAll();
                    $total_page = ceil(count($raw_result)/$num_of_record);
                  
                    $statement = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$search_key%' LIMIT $offset,$num_of_record");
                    $statement->execute();
                    $result = $statement->fetchAll();
                  }
              ?>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <a href="add.php" type="button" class="btn btn-success">New Blog Post</a> <br> <br>
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                  if ($result) {
                    foreach ($result as $value) { ?>
                      <tr>
                        <td><?php echo escape($value['id']); ?></td>
                        <td><?php echo escape($value['title']); ?></td>
                        <td><?php echo escape($value['content']); ?></td>
                        <td>
                            <div class="d-flex">
                              <a href="edit.php?id=<?php echo $value['id']; ?>" class="btn btn-warning m-1" type="button">Edit</a>                
                                <a href="delete.php?id=<?php echo $value['id']; ?>" class="btn btn-danger m-1" type="button" onclick="return confirm('will you delete?');">Delete</a>                   
                            </div>
                        </td>
                        </tr>
                  <?php
                  }}
                  ?>
                  </tbody>
                </table> <br>
                <!-- pagination start -->
                <nav aria-label="Page navigation example" style="float:right;">
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
                <!-- pagination end -->
              </div>
              <!-- card-body end -->
      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>
