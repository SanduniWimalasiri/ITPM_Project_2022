
<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Item</h1>
        <br> <br>

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

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }


        ?>

        <!--Button to add item-->
        <a href="<?php echo SITEURL;?>admin/add-item.php" class="btn-primary">Add Item</a>
        <br> <br> <br>
        
        <table class="tbl-full">
            <tr>
                <th> Iten No</th>
                <th> Iten Name</th>
                <th> Action</th>
            </tr>
            <?php 
                        //create sql query to get all the item                            
                        $sql= "SELECT * FROM tbl_item";

                        //Executing querry
                        $res = mysqli_query($conn,$sql);

                        //count rows to check wheather we have item or not
                        $count = mysqli_num_rows($res); 

                          //create  serial number variable and set default value as 1
                            $sn=1;
                            if($count>0)
                            {
                                //we have item in database
                                //get the item from database and display
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the values from individual columns
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    $price=$row['price'];
                                    $image_name=$row['image_name'];
                                    $active=$row['active'];
                                

                                    ?>

                                    <tr>
                                        <td><?php echo $sn++;;?>.</td>
                                        <td><?php echo $title;?></td>
                                        <td><?php echo $price;?></td>
                                        <?php
                                        //check weather we have image or not
                                        if($image_name=="")
                                        {
                                            //we do not have image display error message
                                            echo "<div class='error'>Image not added.</div>";
                                        }
                                        else
                                        {
                                            //we have image display image
                                            ?>
                                                <img src="<?php echo SITEURL; ?> images/item/<?php echo $image_name;?>"> 
                                            <?php
                                        }
                                        
                                        ?>
                                        
                                        <td><?php echo $active;?></td>
                                        <td> 
                                            <a href="<?php echo SITEURL; ?>admin/update-item.php?id=<?php echo $id; ?>"   class="btn-secondary">Update Item</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-item.php?id=<?php echo $id; ?> &image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Item</a>
                                        </td>   
                                </tr>    

                                
                                    <?php
                                }
                            }
                            else
                            {
                                //item not added in database
                                echo "<tr> <td colspan='7' class='error'> Item not added yet.</td></tr>";
                            }

                        ?>

        </table>
    </div>
</div>





<?php include('partials/footer.php') ?>



