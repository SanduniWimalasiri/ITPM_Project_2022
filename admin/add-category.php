<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>
        <?php
        if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
       
       <form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
    <tr>
        <td>Title :</td>
        <td>
            <input type="text" name="title" placeholder=" Title of the category">
        </td>    
    </tr>

    <tr>
        <td>Select Image :</td>
        <td>
            <input type="file" name="image">
        </td>    
    </tr>


    <tr>
        <td>Featured :</td>
        <td>
            <input type="radio" name="featured" value="Yes">Yes
            <input type="radio" name="featured" value="No">No
        </td>    
    </tr>

    <tr>
        <td>Active :</td>
        <td>
            <input type="radio" name="active" value="Yes">Yes
            <input type="radio" name="active" value="No">No
        </td>    
    </tr>

    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
        </td>
      
    </tr>
</table>
</form> 
<!--add category-->
<?php 

//check whether the button is clicked or not
if(isset($_POST['submit']))
{

    //echo "Clicked";
    //get the value from category form
    $title = $_POST['title'];
   
    //for radio input, we need to check whether the button is selected or not
    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }
    else
    {
        $featured = "No"; //Setting the default value

    }

    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
    else
    {
        $active = "No"; //Setting the default value

    }
     //check whether the image is selected or not  
    /*print_r($_FILES['image']);

    die();*/

    if(isset($_FILES['image']['name']))
    {
            //upload the image
            $image_name = $_FILES['image']['name'];

            //upload the image only if image is selected
            if($image_name != "")
            {

            $ext= explode('.', $image_name);
            $file_extension=end($ext);

            $image_name= "Item_category_".rand(000,999).'.'.$file_extension;


            $source_path = $_FILES['image']['tmp_name'];

            $destination="../images/category/".$image_name;

            $upload = move_uploaded_file($source_path, $destination);

            //check whether the image is uploaded
            //and if the image is not uploaded then we will stop the process and redirect with error message

            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                header('location:'.SITEURL.'admin/add-category.php');

                die();
            }
        }
    }
    else
    {
        $image_name="";

    }
    
    //create sql query to insert category into database
    $sql="INSERT INTO tbl_category SET

    title = '$title',
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'

    ";

    $res = mysqli_query($conn, $sql);


    if($res == true)
    {
        //data inserted successfully
        $_SESSION['add'] = "<div class='success'>Category Added successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');


    }
    else
    {
        //failed to insert data
        $_SESSION['add'] =  "<div class='error'>Failed to  Add category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
} 

    
?>
       
</div>
</div>
<?php include('partials/footer.php'); ?>