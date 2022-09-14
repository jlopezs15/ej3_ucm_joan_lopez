<?php
session_start();
require_once "config.php";


if (isset($_SESSION["username"])) {
    header("location:home.php");
}

if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["usr"]);
    $pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
    $query = "SELECT * FROM users WHERE username= '$username' ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if (password_verify($pwd, $row["pwd"])) {
            $_SESSION["username"] = $username;
            header("location:home.php");
        }
    } else {
        echo ' <script>alert("Error en el login!")</script>';
    }
}

if (isset($_POST["register"])) {

    $regusername = mysqli_real_escape_string($conn, $_POST["usr"]);
    $regpwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
    
    $regpwd = password_hash($regpwd, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users(username, pwd) VALUES('$regusername', '$regpwd')";
    if (mysqli_query($conn, $query)) {
        echo ' <script>alert("Register done!")</script>';
        header("location:index.php");
    }else{
        echo ' <script>alert("Something go wrong!")</script>';
    }
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
        <!-- formulario register -->
        <?php
        if (isset($_GET["action"]) == "register") {



        ?>
            <form method="post">
                <br>
                <h3 class="text-center">Register</h3>

                <div class="form-outline mb-4">
                    <label for="username" class="form-label">username</label>
                    <input type="text" class="form-control" id="username" aria-describedby="username" name="usr" required>
                </div>
                <div class="form-outline mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pwd" required>
                </div>

                <input class="btn btn-primary" type="submit" value="Register" name="register">

                <!-- register button -->
                <div class="text-center">
                    <p>Already a member? <a href="index.php?">Login</a></p>

                </div>
            </form>
            <!-- formulario login -->
        <?php
        } else {
        ?>
            <form method="post">
                <br>
                <h3 class="text-center">LOGIN</h3>

                <div class="form-outline mb-4">
                    <label for="username" class="form-label">username</label>
                    <input type="text" class="form-control" id="username" aria-describedby="username" name="usr" required>
                </div>
                <div class="form-outline mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pwd" required>
                </div>

                <input class="btn btn-primary" type="submit" value="login" name="login">

                <!-- register button -->
                <div class="text-center">
                    <p>Not a member? <a href="index.php?action=register">Register</a></p>

                </div>
            </form>

        <?php
        }
        ?>

    </div>
</body>

</html>