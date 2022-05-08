<html>
    <head>
        <title>Food order website</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
<?php

    include('../config/constant.php');
    if(isset($_GET['id']))
    {
        //Get ID 
        $id = $_GET['id'];

        //Delete Order from database
        $sql = "DELETE FROM tbl_order WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn,$sql);

        //Redirect to manage order with message
        if($res==true)
        {
            $_SESSION = "<div class='success'>Order Deleted Successfully</div>";
            header('location:'.SITEURL.'manage-order.php');
        }
        else
        {
            $_SESSION = "<div class='error'>Failed to delete order</div>";
            header('location:'.SITEURL.'manage-order.php');
        }
            }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Unauthorised Access</div>";
        header('location:'.SITEURL.'manage-order.php');

    }
?>
</html>