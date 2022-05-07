
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Item</h1>
        <br><br>


        <?php 
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
         
        <form action="" method="POST" enctype="multipart/form-data">

        <table border="0" class="tbl-30">
            <tr>
                <td>Title </td>
                <td>
                    <input type="text" name="title" placeholder=" Title of the Item">
                </td>    
            </tr>

            <tr>
                <td>Description </td>
                <td>
                    <textarea name="description" cols="30"  rows="5" placeholder=" Description of the Item"></textarea>
                </td>    
            </tr>

            <tr>
                <td>Price </td>
                <td>
                    <input type="number" name="price" placeholder=" Price of the Item">
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
                            //create php code to display item from database
                            //1 create sql to get all active catogories from database
                            $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //Executing querry
                        $res = mysqli_query($conn,$sql2);

                            //count rows to check wheather we have categories or not
                        $count = mysqli_num_rows($res); 

                            //if count is grater than zero, we have categories else we dont have categories
                            if($count>0)
                            {
                                //we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of categories
                                    $id=$row['id'];
                                    $title=$row['title'];

                                    ?>

                                    <option value="<?php echo $id; ?>"> <?php echo $title;?></option>
                                
                                    <?php
                                }
                            }
                            else
                            {
                                //we havent categories
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }

                            //2 display on dropdown
                            
                        ?>
                  
                    </select>
                </td>
            </tr>

            <tr>
                <td>Active </td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>    
            </tr>

            

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Item" class="btn-secondary">
                </td>
              
            </tr>



        </table>
        </form>


        <?php 

        //check wheather the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the item in database 
            //echo "Clicked";


            //1.get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check wheather radion button for active is checked or not
           
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No"; //Setting the default value

            }

            //2 upload the image if selected 
            //check wheather the select image is  click or not and upload the image only if the image is selected
            if(isset($_FILES['image']['name']))
            {
                //get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //checke whether the image is selected or not and upload image only if selected
                if($image_name !="")
                {
                    //image is selected
                    //A. rename the image 
                    //get the extension of selected image (jpg, png, gif, etc.) "ashan-millewa.jpg ashan-millewa jpg
                    $ext= explode('.', $image_name);
                    $file_extension=end($ext);
        
                    

                    //create new name for image
                    $image_name= "Item_category_".rand(000,999).'.'.$file_extension; //New image name may be "Item-Nmae-657.jpg"

                    //B upload the image
                    //get the src path and destination path\

                    //source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image to be uplosded
                    $dst="../images/item/".$image_name;

                    //finally upload the item image
                    $upload = move_uploaded_file($src, $dst);

                    //check wether image uploaded of not
                    if($upload==false)
                    {
                        //failed to upload the image
                        //redirect to add item page with error message
                        $_SESSION['upload'] = "<div class='error'> Failed to upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-item.php');

                        //STOP the process
                        die();

                    }

                }
            
            }
            else
            {
                $image_name="";//setting default value as blank
            }

            //3 Insert into database

            //create a SQL Query to save or Add item
            //for numerical we do not need to pass the value insde quotes '' but for string value it is compulsory to add quotes''
            $sql1="INSERT INTO tbl_item SET

            title = '$title',
            description = '$description',
            price = $price,
            image_name='$image_name',
            category_id = $category,
          
            active='$active'

            ";
            
            //execute the querry
            $res2 = mysqli_query($conn, $sql1);

            //check whether data inserted or not
            //4 redirect with message to manage item page
            if($res2 == true)
            {
                //data inserted successfully
                $_SESSION['add'] = "<div class='success'>Item Added successfully.</div>";
                header('location:'.SITEURL.'admin/manage-item.php');


            }
            else
            {
                //failed to insert data
                $_SESSION['add'] =  "<div class='error'>Failed to  Add Item.</div>";
                header('location:'.SITEURL.'admin/manage-item.php');
            }
        }   

            
        ?>

                    
    </div>
</div>



<?php include('partials/footer.php') ?>








