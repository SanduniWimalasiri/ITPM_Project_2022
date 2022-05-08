<?php include('partials/menu.php');?>
<div  class="title-text"><h1>View Category</h1></div>
<div class="main-content">
        <div class="wrapper">
            
            <br><br>

            <?php
                //Check whether ID is set or not
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    //Get details based on ID
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";
                    //Execute the query
                    $res = mysqli_query($conn,$sql);
                    //Count rows
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        $row = mysqli_fetch_assoc($res);
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        header("location:".SITEURL."manage-category.php");
                    }
                }
                else
                {
                    header("location:".SITEURL."manage-category.php");
                }
            ?>

                <table class = "tbl-full">
                    <tr>
                        <td><b>Category ID</b></td>
                        <td><?php echo $id;?></td>
                    </tr>
                    <tr>
                        <td><b>Category Title</b></td>
                        <td><?php echo $title;?></td>
                    </tr>

                    <tr>
                        <td><b>Image Name</b></td>
                        <td><?php echo $image_name;?></td>
                    </tr>

                    <tr>
                        <td><b>Featured<b></td>
                        <td><?php echo $featured;?></td>
                    </tr>

                    <tr>
                        <td><b>Active</b></td>
                        <td><?php echo $active;?></td>
                    </tr>
 
                </table>

            
        </div>
</div>
<?php include('partials/footer.php');?>