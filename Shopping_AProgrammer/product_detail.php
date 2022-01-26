<?php 
  session_start();
  include "header.php";
  require "config/config.php";
  require "config/common.php";
  
  if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
    header("Location: login.php");
}
  
  $statement = $pdo->prepare("SELECT * FROM products WHERE id=".$_GET['id']);
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  
  // print_r($_SESSION['cart']);

?>
<!--================Single Product Area =================-->
<div class="product_image_area p-0">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-6">
          <div class="single-prd-item">
            <img class="img-fluid" src="admin/images/<?php echo $result['image']; ?>" alt="">
          </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <div class="s_product_text">
          <h3><?php echo escape($result['name']); ?></h3>
          <h2><?php echo escape($result['price']); ?></h2>
          <ul class="list">
            <li><a href="#"><span>Available</span> : In Stock</a></li>
          </ul>
          <p><?php echo escape($result['description']); ?></p>

          <form action="add_to_cart.php" method="POST">
              <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
              <input type="hidden" name="id" value="<?php echo escape($result['id']); ?>">

              <div class="product_count">
                <label for="quantity">Quantity:</label>    
                <input type="text" name="quantity" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
              </div>
              <div class="card_area d-flex align-items-center">
                <button class="primary-btn">Add to Cart</button>
                <a class="primary-btn" href="index.php">Back</a>
              </div>
          </form> 

        </div>
      </div>
    </div>
  </div>
</div><br>

<?php include('footer.php');?>
