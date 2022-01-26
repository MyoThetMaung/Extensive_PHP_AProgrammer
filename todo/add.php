<?php
    require "config.php";
    if($_POST){
        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "INSERT INTO todo (title,description) VALUES(:title,:description)";
        $pdostatement = $pdo->prepare($sql);
        $result = $pdostatement->execute([
            ":title" => $title,
            ":description" => $description
        ]);

        if($result){
            echo "<script>alert('New to do list is added!');window.location.href='index.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h2>Create New todo</h2>
            <form method="post" action="add.php">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                </div> <br>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea type="text" name="description" rows="8" cols="80" class="form-control"></textarea>
                </div> <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit">
                    <a href="index.php" class="btn btn-dark" type="submit">Back</a>
                </div> 
            </form>
        </div>
    </div>
</body>
</html>