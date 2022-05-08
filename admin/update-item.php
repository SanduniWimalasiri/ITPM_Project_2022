<?php include('partials/menu.php'); ?>

<?php
        //check whether id is set or not
        if(isset($_GET['id']))
        {            
        //check all the details
        $id = $_GET['id'];

        //sql query to get the selected item
        $sql2 = "SELECT * FROM tbl_item WHERE id=$id";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //get all the value based on query executed
        $row = mysqli_fetch_assoc($res2);

        //get all  the individual values of selected item
        
        $title=$row['title'];
        $description=$row['description'];
        $price=$row['price'];
        $current_image=$row['image_name'];
        $current_category=$row['category_id'];
        $active=$row['active'];

        }

        else{
            //redirect to manage item
            header('location:'.SITEURL.'admin/manage-item.php');
        }
        ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Item</h1>
        <br><br>


                
        <form action="" method="POST" enctype="multipart/form-data">

        <table border="0" class="tbl-30">
            <tr>
                <td>Title </td>
                <td>
                    <input type="text" name="title" placeholder=" Title of the Item" value="<?php echo $title ;?>">
                </td>    
            </tr>

            <tr>
                <td>Description </td>
                <td>
                    <textarea name="description" cols="30"  rows="5" placeholder=" Description of the Item" value="<?php echo $description ;?>"></textarea>
                </td>    
            </tr>

            <tr>
                <td>Price </td>
                <td>
                    <input type="number" name="price" placeholder=" Price of the Item" value="<?php echo $price ;?>">
                </td>    
            </tr>

            <tr>
                <td>current Image </td>
                <td>
                Display the Image if Available
                </td>    
            </tr>

            <tr>
                <td>Select Image </td>
                <td>
                <input type="file" name="image" >
                </td>    
            </tr>

            <tr>  
                <td>Category </td>
                <td>
                    <select name="category">

                    <?php 
                            //query to get active category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //Executing querry
                        $res = mysqli_query($conn,$sql);

                            //count rows 
                        $count = mysqli_num_rows($res); 

                            //check whether category available or not
                            if($count>0)
                            {
                                //we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of categories
                                    $category_title=$row['title'];
                                    $category_id=$row['id'];
                                    

                                    ?>

                                    <option  <?php if($current_category==$category_id) {echo "selected";}?>  value="<?php echo $category_id; ?>"> <?php echo $category_title;?></option>
                                
                                    <?php
                                }
                            }
                            else
                            {
                                //category not available
                                echo "<option value='0'>Category Not Available.</option>";
                            }

                    
                        ?>
                  
                    
                  
                    </select>
                </td>
            </tr>

            <tr>
                <td>Active </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No") {echo "checked";}?> type="radio" name="active" value="No">No
                </td>    
            </tr>

            

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" >
                    <input type="hidden" name="current_image" value="<?php echo $current_category; ?>">
                    <input type="submit" name="submit" value="Update Item" class="btn-secondary">
                </td>
              
            </tr>



        </table>
        </form>

    <?php
    if(isset($_POST['submit']))
    {
        //1 get all details from the form
        $id= $_POST['id'];
        $title= $_POST['title'];
        $description= $_POST['description'];
        $price= $_POST['price'];
        $current_image= $_POST['current_image'];
        $category= $_POST['category'];
        $active= $_POST['active'];

        //2 upload the image if selected

        //check whether upload button is clicked or not
        if(isset($_FILES['image']['name']))
        {
            //upload button  clicked
            $image_name = $_FILES['image']['name']; //new image name

            if($image_name !="")
                {
                    //image is available
                    //A, updating new image
                    //rename the image 
                    $ext= explode('.', $image_name);
                    $file_extension=end($ext);
        
                    
                    $image_name= "Item_name_".rand(000,999).'.'.$file_extension; //New image name may be "Item-Nmae-657.jpg"

                
                    //get the source path and destination path\

                    //source path is the current location of the image
                    $src_path = $_FILES['image']['tmp_name'];

                    //destination path for the image to be uplosded
                    $dst_path="../images/item/".$image_name;

                    //finally upload the item image
                    $upload = move_uploaded_file($src_path, $dst_path);

                    //check wether image uploaded of not
                    if($upload==false)
                    {
                        //failed to upload the image
                        $_SESSION['upload'] = "<div class='error'> Failed to upload New Image.</div>";
                        header('location:'.SITEURL.'admin/manage-item.php');

                        //STOP the process
                        die();
                    }

             //3 remove the image if new image is uploaded and current image exists  
            //B remove current image if available
            if($current_image !="")
            {
                //current image is available
                //remove the image
                $remove_path="../images/item/".$current_image;

                $remove = unlink($remove_path);

                //check whether the image is removed or not
                if($remove==false)
                {
                    //failed to remove current image
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                    //redirect to manage item
                    header('location:'.SITEURL.'admin/manage-item.php');
                    //stop the process
                    die();
                }
            }

        } 
            else
            {
                $image_name=$current_image;//default image when image is not selected
            }  

    }     

    else
        {
            $image_name=$current_image;//default image when button is not selected
        }


            //4 update the item in database
            $sql3 = "UPDATE tbl_item SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name='$image_name',
            category_id = '$category',
            active = '$active'
            WHERE id=$id
            ";

            //execute the querry
            $res3 = mysqli_query($conn, $sql3);

            //4 redirect with message to manage item page
            if($res3 == true)
            {
                //data inserted successfully
                $_SESSION['update'] = "<div class='success'>Item Updated successfully.</div>";
                header('location:'.SITEURL.'admin/manage-item.php');


            }
            else
            {
                //failed to insert data
                $_SESSION['update'] =  "<div class='error'>Failed to  Update Item.</div>";
                header('location:'.SITEURL.'admin/manage-item.php');
            }

        //redirect to manage item with session message
    }

        ?>
    </div>
</div>



<?php include('partials/footer.php') ?>








