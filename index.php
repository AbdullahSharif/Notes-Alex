<?php
    include_once("./config/config.php");
    $submitted = false;
    if(isset($_POST["submit"])){
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);
        $r = mysqli_query($connection, "INSERT INTO notes(title, description) VALUES('$title', '$description')");
        
        if($r){
            $submitted = true;
        }

    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes Axel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">Notes Axel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        
        </ul>
        </div>
        </div>
    </nav>  

    <?php
        // echo $submitted;
        if($submitted == true){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' >
            <strong>Added Successfully!</strong> You should check in on some of those fields below.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    ?>

    

    <div class="container">
        <h2 class="my-4">Create a Note</h2>
    <form action="./index.php" class="m-3" method="POST">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Write title..." required>

        
        <div class="form-floating my-3">
         <textarea class="form-control" placeholder="Describe your goal ... " id="description" name="description" style="height: 200px" required></textarea>
         <label for="description">Describe your note ... </label>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Add note">
    </form>

    <h2>Your Notes</h2>
    <?php
        $result = mysqli_query($connection,"SELECT * FROM notes;");
        if(mysqli_num_rows($result)>0){
            echo "
            <table class='table'>
            <thead>
            <tr>
              <th scope='col'>Serial #</th>
              <th scope='col'>Title</th>
              <th scope='col'>Description</th>
              <th scope='col'>Date Added</th>
              <th scope='col'>Actions</th>
            </tr>
          </thead>
          <tbody>
          ";

        while($res = mysqli_fetch_array($result)){
        echo "<tr>
        <td>".$res['serialNo']."</td>
        <td>".$res['title']."</td>
        <td>".$res['description']."</td>
        <td>".$res['dateAdded']."</td>
        <td></td>
        </tr>" ;   
        }
        echo "</tbody>
        </table>";
        }
        else{
            echo "<p>You have no records!</p>";
        }

    ?>
    </div>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>