
<?php include('partials/menu.php'); ?>
 
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
       
                $id=$_GET['id'];
            
            ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Change Password">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php
        if(isset($_POST['submit']))
        {
            // $id=$_POST['id'];
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND `password`='$current_password'";

            $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res))
            {
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    // echo "1111";
                    // die();
                    //echo "User Found";
                    if($new_password==$confirm_password)
                    {
                            $sql2 = "UPDATE tbl_admin SET  `password`='$new_password' WHERE id=$id
                            ";

                            $res2 = mysqli_query($conn, $sql2);
                            
                            if($res2==true)
                            {
                                $_SESSION['Change-password'] = "Password Changed Successfully.";

                                header('location:'.SITEURL.'admin/manage-admin.php');

                            }
                            else
                            {
                                $_SESSION['Change-password'] = "Failed to Change Password.";

                                header('location:'.SITEURL.'admin/manage-admin.php');

                            }

                            if(isset($_SESSION['change password']))
                            {
                                echo $_SESSION['change password'];
                                unset($_SESSION['change password']);
                            }

                    }
                    else
                    {
                        $_SESSION['password-not-match'] = "Password Did not path";

                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }
                }
                else
                {
                    $_SESSION['user-not-found'] = "User Not Found";

                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        }
?>