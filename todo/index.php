<?php 
    require "config.php";

  
    $pdostatement = $pdo->prepare("SELECT * FROM todo");
    $pdostatement->execute();
    $result = $pdostatement->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo</title></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
        <div class="card">
            <div class="card-body">
                <h2>To do list</h2>
                <a href="add.php" class="btn btn-success" type="button">Create New </a> 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>description</th>
                            <th>created_at</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                            if($result){
                                foreach($result as $value){ ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?>  </td>
                                        <td><?= $value['title']; ?></td>
                                        <td><?= $value['description']; ?></td>
                                        <td><?= date("Y-m-d",strtotime ($value['created_at'])); ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $value['id']; ?>" type="button" class="btn btn-warning" >Edit</a>
                                            <a href="delete.php?id=<?php echo $value['id']; ?>" type="button" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                    }}
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>