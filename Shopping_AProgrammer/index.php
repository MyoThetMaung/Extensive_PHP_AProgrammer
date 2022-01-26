<?php 
	session_start();
	require 'config/common.php';
    require "config/config.php";

  if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
      header("Location: login.php");
  }

  $statement = $pdo->prepare("SELECT * FROM products ORDER BY id DESC");
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
		if(!empty($_GET['category_id'])){
			$category_id = $_GET['category_id'];
			$statement = $pdo->prepare("SELECT * FROM products WHERE category_id=$category_id AND category > 0 ORDER BY id DESC");
			$statement->execute();
			$raw_result = $statement->fetchAll();
			$total_page = ceil(count($raw_result)/$num_of_record);
		  
			$statement = $pdo->prepare("SELECT * FROM products WHERE category_id=$category_id AND category > 0 ORDER BY id DESC LIMIT $offset,$num_of_record");
			$statement->execute();
			$result = $statement->fetchAll();
		}
    }else{
		$search_key = $_POST['search'];
		$statement = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%search_key%' AND category > 0 ORDER BY id DESC");
		$statement->execute();
		$raw_result = $statement->fetchAll();
		$total_page = ceil(count($raw_result)/$num_of_record);
	  
		$statement = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%search_key%' AND category > 0 ORDER BY id DESC LIMIT $offset,$num_of_record");
		$statement->execute();
		$result = $statement->fetchAll();
	}
?>
<?php include('header.php') ?>
<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Browse Categories</div>
					<ul class="main-categories">
						<li class="main-nav-list">
							<?php 
								$category_state = $pdo -> prepare("SELECT * FROM categories ORDER BY id DESC");
								$category_state -> execute();
								$category_result = $category_state -> fetchAll();

								foreach ($category_result as $key => $value) {
							?>
							<a href="index.php?category_id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a>
								<?php }?>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<div class="filter-bar d-flex ">
					<div class="pagination">
						<li class="page-item"><a class="page-link" href="?page_no=1">First</a></li>
						<li class="page-item <?php if($page_no <= 1){echo 'disabled';} ?>">
							<a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{echo '?page_no='.($page_no-1);} ?>">Previous</a>
						</li>
						<li class="page-item"><a class="page-link" href="#"><?php echo $page_no; ?></a></li>
						<li class="page-item <?php if($page_no >= $total_page){echo 'disabled';} ?>">
						<a class="page-link" href="<?php if($page_no >= $total_page){echo '#';}else{echo '?page_no='.($page_no+1);} ?>">Next</a>
						</li>
						<li class="page-item"><a class="page-link" href="?page_no=<?php echo $total_page; ?>">Last</a></li>
					</div>
				</div>
			

			<section class="lattest-product-area pb-40 category-list">
				<div class="row">
					<!-- single product -->
					<?php 
						if($result){
							foreach ($result as $key => $value) {
					?>
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<a href="product_detail.php?id=<?php echo $value['id']; ?>"><img class="img-fluid" src="admin/images/<?php echo escape($value['image']);?>" style="height:250px;"></a>
							<div class="product-details">
								<h6><?php echo escape($value['name']); ?></h6>
								<div class="price">
									<h6><?php echo escape($value['price']); ?></h6>
								</div>
								<div class="prd-bottom">
									<form action="add_to_cart.php" method="post">
										<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
										<input type="hidden" name="id" value="<?php echo escape($value['id']); ?>">
										<input type="hidden" name="quantity" value="1">

										<div class="social-info">	
											<button type="submit" class="social-info" style="display:contents" >
												<span class="ti-bag"></span><br><br><p style="left: 20px;" class="hover-text">add to cart</p>
											</button>
											<a href="product_detail.php?id=<?php echo escape($value['id']); ?>" class="social-info">
												<span class="lnr lnr-move"></span>
												<p class="hover-text">view more</p>
											</a>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
					<?php }} ?>
				</div>
				</div>	
			</section>
			<!-- End Best Seller -->
<?php include('footer.php');?>
