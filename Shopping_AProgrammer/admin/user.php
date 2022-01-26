
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
              <h1 class="card-title">User List</h1>
            </div>
            <?php
              
              if(!empty($_GET['page_no'])){
                $page_no = $_GET['page_no'];
                }else{
                  $page_no = 1; 
                }
                $num_of_record = 4;
                $offset = ($page_no -1) * $num_of_record;
              
                if(empty($_POST['search'])){
                  $statement = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
                  $statement->execute();
                  $raw_result = $statement->fetchAll();
                  $total_page = ceil(count($raw_result)/$num_of_record);
                
                  $statement = $pdo->prepare("SELECT * FROM users LIMIT $offset,$num_of_record");
                  $statement->execute();
                  $result = $statement->fetchAll();
                }else{
                  $search_key = $_POST['search'];
                  $statement = $pdo->prepare("SELECT * FROM users WHERE name LIKE '%$search_key%' ORDER BY id DESC");
                  $statement->execute();
                  $raw_result = $statement->fetchAll();
                  $total_page = ceil(count($raw_result)/$num_of_record);
                
                  $statement = $pdo->prepare("SELECT * FROM users WHERE name LIKE '%$search_key%' LIMIT $offset,$num_of_record");
                  $statement->execute();
                  $result = $statement->fetchAll();
                }
            
            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <a href="user_add.php" type="button" class="btn btn-success">User Add</a> <br> <br>
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                if ($result) {
                  foreach ($result as $value) { ?>
                    <tr>
                    <td><?php echo escape($value['id']); ?></td>
                    <td><?php echo escape($value['name']); ?></td>
                    <td><?php echo escape($value['email']); ?></td>
                    <td><?php echo escape($value['phone']); ?></td>
                    <td><?php echo escape($value['address']); ?></td>
                    <td><?php if($value['role']==1){echo "admin";}else{echo "user";} ?></td>
                    <td>
                        <div class="d-flex">
                        <a href="user_edit.php?id=<?php echo escape($value['id']); ?>" class="btn btn-warning m-1" type="submit">Edit</a>                
                        <a href="user_delete.php?id=<?php echo escape($value['id']); ?>" class="btn btn-danger m-1" type="submit" onclick="return confirm('will you delete user?');">Delete</a>                   
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
