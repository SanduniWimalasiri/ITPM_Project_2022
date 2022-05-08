<?php

    //start session
    session_start();



    //Create constants
    define('SITEURL','http://localhost:8012/ITPM_Project_2022/');
    define('LOCALHOST','localhost:3307');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','itpm_project_2022');

    //Connect the database
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD)or die(mysqli_error());
    //Select database
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());


?>