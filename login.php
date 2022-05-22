<!DOCTYPE html>
<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">

        </div>


    </body>
</html>

<?php

        if(isset($_POST['submit']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            //$sql = "SELECT * FROM tbl_login WHERE user_name='$username' AND password='$password'";
            $sql = "SELECT * FROM tbl_login WHERE username='$username' AND password='$password'" ;
            
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res); 

            if($count==1)
            {
                $_SESSION['login'] = "<div class='succcess'>Login Successful.</div>";

                header('location:'.SITEURL.'admin/');
            }
            else
            {
                $_SESSION['login'] = "<div class='error'>Username or Password did not match.</div>";

                header('location:'.SITEURL.'admin/login.php');
                
            }
        }

?>