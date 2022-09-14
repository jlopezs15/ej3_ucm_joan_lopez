<?php

    define('DB_SERVER','db');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','secret');
    define('DB_NAME','docker');

    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

    if ($conn == false){
        die("ERROR : " . mysqli_connect_errno());
    }

?>