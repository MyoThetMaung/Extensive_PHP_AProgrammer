
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

if ($_POST) {
  
  if(empty($_POST['name']) || empty($_POST['description'])){
    if(empty($_POST['name'])){
      $name_error = "Name cannot be null";
    }
    if(empty($_POST['description'])){
      $description_error = "Description cannot be null";
    }

}else{
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];

   $statement = $pdo->prepare("UPDATE categories SET name='$name', description='$description' WHERE id=$id");
   $result = $statement->execute();
   if ($result) {
        echo "<script>alert('Category updated successfully!');window.location.href='category.php';</script>";
    }
  }
}

  $statement = $pdo->prepare("SELECT * FROM categories WHERE id=".$_GET['id']);
  $statement->execute();
  $result = $statement->fetchAll();
?>

<?php include ("header.php"); ?>
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-body">
              <form action="category_edit.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $result[0]['id']; ?>">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                  <div class="form-group">
                      <label for="">Name</label> <p style="color:red;"><?php echo empty($name_error) ? "" : $name_error; ?></p>
                      <input type="text" name="name" class="form-control" value="<?php echo escape($result[0]['name']); ?>">
                  </div>
                  <div class="form-group">
                      <label for="">Description</label> <p style="color:red;"><?php echo empty($description_error) ? "" : $description_error; ?></p>  
                      <textarea type="text" name="description" rows="8" cols="50" value="" class="form-control"><?php echo escape($result[0]['description']); ?></textarea>
                  </div>
                  <input type="submit" class="btn btn-primary" name="submit" value="Update">
                  <a href="category.php" class="btn btn-dark">Back</a>
              </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<?php include ("footer.php"); ?>
