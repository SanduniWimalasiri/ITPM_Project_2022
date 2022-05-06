<?php include('partials/menu.php');?>

    <!-- main content section starts here-->
        <div class = "main-content">
            <div class= "wrapper">
                <h1> Manage Category</h1>
                <br> <br>
        <?php

        if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
        if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
        if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        if(isset($_SESSION[' failed_removed']))
            {
                echo $_SESSION[' failed_removed'];
                unset($_SESSION[' failed_removed']);
            }
            
           
        ?>

    <br><br>
                <!-- button to add category-->
                <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br><br> <br>
                <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php
                //get all the data from database
                $sql = "SELECT * FROM tbl_category";

                //execute query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                $sn=1;

                //check whether we have category details in database or not
                if($count>0)
                {
                    //we have category details in database
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                     ?>
                      <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                                if($image_name!="") 
                                { 
                                    ?>
                                     <img src="<?php echo SITEURL;?> images/category/<?php echo $image_name;?> " width="100px">
                                    
                                     <?php
                            
                                }
                                else
                                {
                                    echo "<div class='error'> image not added.</div>";
                                }
                        
                            ?>
                        
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td> <?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"class = "btn-secondary"> Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?> "class="btn-danger" >Delete</a>
                        </td>
                      </tr>

                     <?php
                    }
                }
                 else
                {
                    ?>
                    <tr>
                        <td colspan="6"><div class="error">No category added.</div></td>
                    </tr>

                    <?php
                }  
                ?>   
                </table>   
            </div>
        </div>
    <!-- main content section ends here -->

<?php include('partials/footer.php'); ?>