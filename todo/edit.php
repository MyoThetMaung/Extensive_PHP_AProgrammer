<?php
    require 'config.php';

    if($_POST){
       $id = $_POST['id'];
       $title = $_POST['title'];
       $description = $_POST['description'];
       $pdostatement = $pdo->prepare("UPDATE todo SET title='$title', description='$description' WHERE id=".$id);
       $result = $pdostatement -> execute();
       
       if($result){
           echo "<script>alert('to do list is updated!');window.location.href='index.php';</script>";
       }

    }else{
        $pdostatement = $pdo->prepare("SELECT * FROM todo WHERE id=".$_GET['id']);
        $pdostatement -> execute();
        $result = $pdostatement->fetchAll();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h2>Edit todo</h2>
            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo $result[0]['id']; ?>">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $result[0]['title']; ?>">
                </div> <br>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea type="text" name="description" rows="8" cols="80" class="form-control"><?php echo $result[0]['description']; ?></textarea>
                </div> <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Update">
                    <a href="index.php" class="btn btn-dark" type="submit">Back</a>
                </div> 
            </form>
        </div>
    </div>
</body>
</html>    