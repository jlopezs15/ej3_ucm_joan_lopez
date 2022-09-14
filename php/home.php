<?php

session_start();
require_once "config.php";
if (!isset($_SESSION["username"])) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Introduction to PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container align-middle">
        <br>
        <div class="row">
            <?php
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result)>0){

                while($row = mysqli_fetch_assoc($result)){
                echo 
                '
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">USER::'.$row["username"].'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">ID::'.$row["id"].'</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                ';
                }
            }

            
            ?>

        </div>


        <div>
            <a class="row" href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>