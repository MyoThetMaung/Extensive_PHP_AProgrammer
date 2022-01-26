
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
    if(empty($_POST['title']) || empty($_POST['content']) || empty($_FILES['image'])){
        if(empty($_POST['title'])){
          $title_error = "Title cannot be null";
        }
        if(empty($_POST['content'])){
          $content_error = "Content cannot be null";
        }
        if(empty($_FILES['image'])){
          $image_error = "Image cannot be null";
        }
    }else{
        $file = "images/".($_FILES['image']['name']);
        $image_type = pathinfo($file, PATHINFO_EXTENSION);
        if($image_type != 'jpeg' && $image_type != 'png' && $image_type != 'jpg'){
            echo "image type must be png or jpeg format";
        }else{
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $file);
            
            $author_id = $_SESSION['user_id'];
            $statement = $pdo->prepare("INSERT INTO posts(title,content,image,author_id) VALUES('$title','$content','$image','$author_id')");
            $result = $statement->execute();
            if($result){
                echo "<script>alert('upload successfully!'); window.location.href='index.php';</script>";
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
              <form action="add.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                  <div class="form-group">
                      <label for="">Title</label> <p style="color:red;"><?php echo empty($title_error) ? "" : $title_error; ?></p>
                      <input type="text" name="title" class="form-control" value="">
                  </div>
                  <div class="form-group">
                      <label for="">Content</label> <p style="color:red;"><?php echo empty($content_error) ? "" : $content_error; ?></p>  
                      <textarea type="text" name="content" rows="8" cols="50" value="" class="form-control"></textarea>
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
