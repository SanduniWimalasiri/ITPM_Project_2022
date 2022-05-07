<?php include('partials/menu.php');?>

<!--Content Start-->
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

        <form action='' method='POST' enctype="multipart/form-data">

            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type='text' name='title' placeholder='Title of the Item'>
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name='description' cols='25' rows='10' placeholder='Description of the Item'>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type='number' name='price'>
                    </td>
                </tr>

                <tr>
                    <td>Select_Image:</td>
                    <td>
                        <input type='file' name='image' placeholder='Description of the Item'>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name='category'>
                            <option value='1'>Televisions</option>
                            <option value='1'>Refrigarators</option>
                            <option value='1'>Mobile-Phones</option>
                            <option value='1'>Laptops</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type='radio' name='featured' value='yes'> Yes 
                        <input type='radio' name='featured' value='no'> No
                    </td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <input type='submit' name='submit' value='Add Item' class='btn-c'>
                    </td>
                </tr>

            </table>
        </form>

        <?php
            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the item to the database
                //Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether the radio button is checked or not
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting the default value
                }

                //Upload the image if selected
                //Check whether the select image is clicked or notand upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];
                    //Check whether the image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //Rename the image
                        //Get the extension of selected image
                        $ext = explode('.',$image_name);
                        $file_extension = end($ext);
                        //Create new name for image
                        $image_name = "Item-Name.".rand(0000,9999).".".$file_extension;

                        //Upload the image
                        //Get the source path and the destination path

                        //Source path = current location of the image
                        $src = $_FILES['image']['tmp_name'];
                        //Destination path
                        $dst = "../images/".$image_name;
                        $upload = move_uploaded_file($src,$dst);

                        //Check whether image uploaded or not
                        if($upload==false)
                        {
                            //Failed to upload the image
                            //Redirect to add item page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('location:'.SITEURL.'add-item.php');
                            //stop the process
                            die();


                        }


                    }

                }
                else
                {
                    $image_name = "";//Setting default value as blank
                }
                //Insert into DB
                //Create a SQL query to save
                $sql2 = "INSERT INTO item SET
                Title = '$title',
                Description = '$description',
                Price = $price,
                Select_Image = '$image_name',
                Category = '$category',
                Available = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn , $sql2);
                //Check whether data inserted or not
                //Redirect the message to manage item page
                if($res2 == true)
                {
                    $_SESSION['add'] = "<div class='success'>Item Added Successfully</div>";
                    header('location:'.SITEURL.'manage-item.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to add item</div>";
                    header('location:'.SITEURL.'manage-item.php');
                }
                

            }
        
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>