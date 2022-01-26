
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


if($_POST){
    if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['quantity']) || empty($_POST['price']) ||
       empty($_POST['category']) ||empty($_FILES['image'])){
        if(empty($_POST['name'])){
          $name_error = "Name is required";
        }
        if(empty($_POST['description'])){
          $description_error = "Description is required";
        }
        if(empty($_POST['category'])){
          $category_error = "Category is required";
        }
        if(empty($_POST['quantity'])){
          $quantity_error = "Quantity is required";
        }elseif(is_numeric($_POST['quantity']) != 1){
          $quantity_error = "Quantity should be integer value";
        }
        if(empty($_POST['price'])){
          $price_error = "Price is required";
        }elseif(is_numeric($_POST['price']) != 1){
          $price_error = "Price should be integer value";
        }
        if(empty($_FILES['image'])){
          $image_error = "Image is required";
        }
    }
    
    else{
      if(is_numeric($_POST['quantity']) != 1){
        $quantity_error = "Quantity should be integer value";
      }
      if(is_numeric($_POST['price']) != 1){
        $price_error = "Price should be integer value";
      }
    if($quantity_error == '' && $price_error ==''){
      $file = "images/".($_FILES['image']['name']);
      $image_type = pathinfo($file, PATHINFO_EXTENSION);
      if($image_type != 'jpeg' && $image_type != 'png' && $image_type != 'jpg'){
          echo "image type must be png or jpeg format";
      }else{
          $name = $_POST['name'];
          $description = $_POST['description'];
          $category_id = $_POST['category'];
          $price = $_POST['price'];
          $quantity = $_POST['quantity'];
          $image = $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], $file);
          
          $author_id = $_SESSION['user_id'];
          $statement = $pdo->prepare("INSERT INTO products(name,description,category_id,price,quantity,image) 
                                            VALUES('$name','$description','$category_id','$price','$quantity', '$image')");
          $result = $statement->execute();
          if($result){
              echo "<script>alert('Product added successfully!'); window.location.href='index.php';</script>";
          }
        }   
      }
    }
}

?>

<?php include "header.php"; ?>
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-body">
              <form action="product_add.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                  <div class="form-group">
                      <label for="">Name</label> <p style="color:red;"><?php echo empty($name_error) ? "" : $name_error; ?></p>
                      <input type="text" name="name" class="form-control" value="">
                  </div>

                  <div class="form-group">
                      <label for="">Description</label> <p style="color:red;"><?php echo empty($description_error) ? "" : $description_error; ?></p>  
                      <textarea type="text" name="description" rows="8" cols="50" value="" class="form-control"></textarea>
                  </div>

                  <div class="form-group">
                    <?php
                         $statement = $pdo->prepare("SELECT * FROM categories");
                         $statement->execute();
                         $cat_result = $statement->fetchAll();
                    ?>
                      <label for="">Category</label> <p style="color:red;"><?php echo empty($category_error) ? "" : $category_error; ?></p>
                      <select name="category" class="form-control">
                        <option value="">SELECT CATEGORY</option>
                        <?php foreach ($cat_result as $value) { ?>
                          
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>

                        <?php } ?>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="">Quantity</label> <p style="color:red;"><?php echo empty($quantity_error) ? "" : $quantity_error; ?></p>
                      <input type="number" name="quantity" class="form-control" value="">
                  </div>

                  <div class="form-group">
                      <label for="">Price</label> <p style="color:red;"><?php echo empty($price_error) ? "" : $price_error; ?></p>
                      <input type="number" name="price" class="form-control" value="">
                  </div>

                  <div class="form-group">
                      <label for="">Image</label>  <p style="color:red;"><?php  echo empty($image_error) ? "" : $image_error; ?></p> 
                      <input type="file" name="image" value="" >
                  </div>

                  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                  <a href="index.php" class="btn btn-dark">Back</a>
              </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
