<?php include('partials/menu.php'); ?>
<div class="title-text">
    <h1>Update Category</h1>
    <br><br>
</div>
<div class="main-content">
    <div class="wrapper">
        
        <br><br>

        <?php
            //check whether the id set or not
            if(isset($_GET['id']))
            {
                //get id and all the other details
                $id = $_GET['id'];
                //create sql query to get all other detials
                $sql = "SELECT * FROM  tbl_category WHERE id=$id";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //get all the data 
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //redirect to manage category page with session message
                    $_SESSION['no-category-found'] = "<div class ='error'>category not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }            
            else
            {
                //ridirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30 background-color">
            <tr>
                <td>Title :</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td> Current Image</td>
                <td>
                    <?php
                        if($current_image !="")
                        {
                            //display the current image
                            ?>
                                <img src ="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="130px">
                                
                            <?php
                        }
                        else
                        {
                            //display a message
                            echo"<div class='error'>Image Not Added</div>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured</td>
                <td>
                    <input <?php if ($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if ($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active</td>
                <td>
                    <input  <?php if ($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input  <?php if ($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>       
            </tr>

            <tr>
                <td>
                    <br>
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
        <?php
            if (isset($_POST['submit'])) 
            {
                //1.get all the values from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured =$_POST['featured'];
                $active = $_POST['active'];

                //2.updating image
                //check whether the image is selected or not

                if (isset($_FILES['image']['name']))
                {
                    //get image details
                    $image_name = $_FILES['image']['name'];

                    //check whether the image available or not
                    if ($image_name != "")
                    {
                        //image available
                        //A. upload new image
                        $ext= end(explode('.', $image_name));

                        $image_name= "Item_category_".rand(000,999).'.'.$ext;
            
            
                        $source_path = $_FILES['image']['tmp_name'];
            
                        $destination="../images/category/".$image_name;
            
                        $upload = move_uploaded_file($source_path, $destination);
            
                        //check whether the image is uploaded
                        //and if the image is not uploaded then we will stop the process and redirect with error message
            
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
            
                            die();
                        }
                        //B.remove current image if available
                        if ($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);
    
                            //check whether ther image is removed or not
                            //if failed to remove display msg and stop the process
                            if ($remove==false) 
                            {
                                //failed to remove image
                                $_SESSION['failed_removed'] = "<div class = 'error'>Failed to remove current image </div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                }
                else
                {
                    $image_name = $current_image;
                }

                //3.Update the database
                $sql3 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured ='$featured',
                    active ='$active'
                    WHERE id =$id
                ";

                //execute the query
                $res3 = mysqli_query($conn,$sql3);

                //4.ridirect to manage category page with a message

                //check whether the query executed or not
                if($res3==true)
                {
                    //category updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>
