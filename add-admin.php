<?php include('../config/constants.php'); ?>



<div class ="main-content">
    <div class="wrapper">
        <h1>Add Admin<h1>

        <br><br>

        <?php
            if(isset($_SESSION['ADD']))
            {
                echo $_SESSION['Add Successfully'];
                unset($_SESSION['Add Successfully']);
            } 
         ?>

        <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>

                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="Username" placeholder="Your  Username"></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="Password" placeholder="Your Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-admin">
                        </td>
                    </tr>



                </table>


        </form>
    </div>
</div>


<?php
if(isset($_POST['submit']))

{

      $full_name = $_POST['full_name'];
      $Username = $_POST['Username'];
      $Password = md5($_POST['Password']);
      
     $sql = "INSERT INTO tbl_admin  SET
        full_name= '$full_name',
        Username= '$Username',
        Password= '$Password'
        ";
     
     $res = mysqli_query($conn, $sql) or die(mysqli_error());
 
     if($res==TRUE)
     {
        //echo "Data Inserted";
        $_SESSION['add'] = "Admin added successfully";
        header("location:".SITEURL.'admin/manage-admin.php');
     }
     else
     {
        //echo "Failed to inserted";
        $_SESSION['add'] = "Failed to add admin";
        header("location:".SITEURL.'admin/add-admin.php');
     }     
}

?>