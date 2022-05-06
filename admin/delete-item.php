<?php
    //include constants page
    include('../config/constants.php');


    if(isset($_GET['id']) && isset($_GET['image_name']))//Either use && or AND
    {
        //process to delete
        //echo "Process to Delete";

        //1.get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2.remove the image if available
        //check whether the image is available or not and delete only if available
        if($image_name !="")
        {
            //it has image and need to remove from folder
            //get the image path
            $path ="../images/item/".$image_name;

            //remove image file from folder 
            $remove = unlink($path);

            //check whether the image is removed or not
            if($remove==false)
            {
                //failed to remove image
                $_SESSION['upload']="<div class='error'>Failed to remove Image File.</div>";
                //redirect to manage item
                header('localhost:'.SITEURL.'admin/manage-item.php');
                //stop the process of deleting item
                die();
            }
        }

        //3.delete item from database
        $sql = "DELETE FROM tbl_item WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn,$sql);

        //check whether the query executed or not and set the session message respectively
        if($res==true)
        {
            //item deleted
            $_SESSION['delete'] = "<div class='sucess'> Item Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-item.php');

        }
        else{
            //failed to delete item
            $_SESSION['delete'] = "<div class='error'> Failed to Delete Item.</div>";
            header('location:'.SITEURL.'admin/manage-item.php');
        }


        //4. redirect to manage item with session message

    }
    else
    {
        //Redirect to manage item page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('localhost:'.SITEURL.'admin/manage-food.php');
    }
?>