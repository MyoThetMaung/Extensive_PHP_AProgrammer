
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
              <h1 class="card-title"> <a href="" type="button" class="btn btn-success">Order List</a></h1>
            </div>
            <?php
                $id = $_GET['id'];
                $statement = $pdo->prepare("SELECT * FROM sale_order_detail WHERE sale_order_id=$id");
                $statement->execute();
                $result = $statement->fetchAll();

             
    
            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                if ($result) {
                  foreach ($result as $value) { 
                    $statement = $pdo->prepare("SELECT * FROM products WHERE id=".$value['product_id']);
                    $statement->execute();
                    $product_result = $statement->fetchAll();   

                ?>
                    <tr>
                      <td><?php echo escape($value['id']); ?></td>
                      <td><?php echo escape($product_result[0]['name']); ?></td>
                      <td><?php echo escape($product_result[0]['quantity']); ?></td>
                      <td><?php echo escape(date('Y-m-d',strtotime($value['order_date']))); ?></td>
                      <td>
                          <div class="d-flex">
                            <a href="order.php" class="btn btn-warning m-1" type="button">Back</a>                
                      </td>
                      </tr>
                <?php
                }}
                ?>
                </tbody>
              </table> <br>
            </div>
            <!-- card-body end -->
    
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
