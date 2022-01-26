
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
              <h1 class="card-title">Monthly Report</h1>
            </div>
            <?php
                $current_date = date("Y-m-d");
                $statement = $pdo->prepare("SELECT * FROM sale_orders WHERE total_price >= 20000 ORDER BY id DESC");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" id="d-table">
                <thead>
                  <tr>
                    <th>User Name</th>
                    <th>Total Amount</th>
                    <th>Order date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if ($result) {
                    foreach ($result as $value) { 
                      $statement = $pdo->prepare("SELECT * FROM users WHERE id=".$value['user_id']);
                      $statement->execute();
                      $user_result = $statement->fetchAll();   
                      ?>
                      <tr>
                        <td><?php echo escape($user_result[0]['name']); ?></td>
                        <td><?php echo escape($value['total_price']); ?></td>
                        <td><?php echo escape($value['order_date']); ?></td>
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
<script>
    $(document).ready( function () {
    $('#d-table').DataTable();
} );
</script>
