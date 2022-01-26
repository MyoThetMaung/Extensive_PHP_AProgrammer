
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
  
  if(empty($_POST['title']) || empty($_POST['content'])){
    if(empty($_POST['title'])){
      $title_error = "Title cannot be null";
    }
    if(empty($_POST['content'])){
      $content_error = "Content cannot be null";
    }

}else{
  $id = $_POST['id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  if ($_FILES) {
      $file = "images/".($_FILES['image']['name']);
      $image_type = pathinfo($file, PATHINFO_EXTENSION);

      $image = $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], $file);
      
      $author_id = $_SESSION['user_id'];
      $statement = $pdo->prepare("UPDATE posts SET title='$title', content='$content', image='$image', author_id='$author_id' WHERE id=$id");
      $result = $statement->execute();
      if ($result) {
          echo "<script>alert('updated successfully!');window.location.href='index.php';</script>";
      }
  }else{
      $statement = $pdo->prepare("UPDATE posts SET title='$title',content='$content' WHERE id=$id");
      $result = $statement->execute();
      if ($result) {
          echo "<script>alert('updated successfully!');window.location.href='index.php';</script>";
      }
  }
}
}
   
  $statement = $pdo->prepare("SELECT * FROM posts WHERE id=".$_GET['id']);
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
              <form action="edit.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                  <div class="form-group">
                      <input type="hidden" name="id" value="<?php echo $result[0]['id']; ?>">
                      <label for="">Title</label> <p style="color:red;"><?php echo empty($title_error) ? "" : $title_error; ?></p>
                      <input type="text" name="title" class="form-control" value="<?php echo escape($result[0]['title']); ?>" >
                  </div>
                  <div class="form-group">
                      <label for="">Content</label>  <p style="color:red;"><?php echo empty($content_error) ? "" : $content_error; ?></p>
                      <textarea type="text" name="content" rows="8" cols="50" value="" class="form-control" ><?php echo escape($result[0]['content']); ?></textarea>
                  </div>
                  <div class="form-group">
                      <label for="">Image</label> <p style="color:red;">
                      <img src="images/<?php echo $result[0]['image']; ?>" width="150px" height="150px" alt="">
                      <input type="file" name="image" value="" class="form-control">
                  </div>
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <a href="index.php" class="btn btn-dark">Back</a>
              </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<?php include ("footer.php"); ?>
