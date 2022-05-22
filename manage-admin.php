
<?php include('../config/constants.php'); ?>

    <head>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br /><br />

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['Password-not-match']))
            {
                echo $_SESSION['Password-not-match'];
                unset($_SESSION['Password-not-match']);
            }
        ?>
        <br>


        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <table class="tbl-full">
            <tr>
                <th>Register Number</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>

            <?php
                
                $sql = "SELECT * FROM tbl_admin";

                $res = mysqli_query($conn,$sql);

                if  ($res==TRUE)
                {
                    $count = mysqli_num_rows($res);

                    $sn=1;

                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];
                            ?>

                                    <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-Change">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-Update">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-Delete">Delete Admin</a>
                                        </td>
                                    </tr>
                            <?php

                        }
                    }
                    else
                    {

                    }
                }
            ?>



        </table>

</div>
</div>