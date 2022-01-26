
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
              <h1 class="">Monthly Report</h1> <br>
              <h3 class="card-title text-success">Items which are sold above quantity of 2</h3>
            </div>
            <?php
                $current_date = date("Y-m-d");
                $statement = $pdo->prepare("SELECT * FROM sale_order_detail GROUP BY product_id HAVING SUM(quantity)>2 
                                                   ORDER BY id DESC");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" id="d-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if ($result) {
                      $i = 1;
                    foreach ($result as $value) { 
                      $statement = $pdo->prepare("SELECT * FROM products WHERE id=".$value['product_id']);
                      $statement->execute();
                      $product_result = $statement->fetchAll();   
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo escape($product_result[0]['name']); ?></td>
                  <?php
                  $i++;
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
<script>
    $(document).ready( function () {
    $('#d-table').DataTable();
} );
</script>
