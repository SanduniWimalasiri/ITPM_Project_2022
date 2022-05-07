<?php

    //Start session
    session_start();

    //Creating constants to store non repeting values
    define('SITEURL','http://localhost/OrderItem/admin/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','item-order');


    //Database connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    //Selecting Database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>