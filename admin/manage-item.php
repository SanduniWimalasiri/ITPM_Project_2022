<?php include('partials/menu.php');?>

        <!--Content Start-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Item</h1>
                <br>
                <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            </div>
            <br>

            <a href="add-item.php" class="btn-c">Add Item</a>
            
        <table class="tab">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        <?php
            //Create a SQL query to get all the Items
            $sql = 'SELECT * FROM item';

            //Execute the query
            $res = mysqli_query($conn,$sql);

            //Count rows to check whether Items are in tha table
            $count = mysqli_num_rows($res);

            //Create Number variable and set default value as 1
            $n=1;

            if($count>0)
            {
                //Get the Items from database and display
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['Item_No'];
                    $title = $row['Title'];
                    $price = $row['Price'];
                    $image_name = $row['Select_Image'];
                    ?>

            <tr>                                   
                <td><?php echo $n++;?></td>
                <td><?php echo $title;?></td>
                <td><?php echo $price;?></td>
                <td><?php 
                        //Check whether have image or not
                        if($image_name=="")
                        {
                            echo "<div class='error'>Image not added</div>";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL;?>images/<?php echo $image_name;?>" width="50px">
                            <?php
                        }
                
                    ?>
                </td>
                <td>
                    <a href="#" class="btn-a">Update Item</a>
                    <a href="#" class="btn-b">Delete Item</a>
                </td>
            </tr>
                    <?php 
                }
            }
            else
            {
                echo "<tr><td colspan='5' class='error'> Items Not Added Yet </td></tr>";
            }
        ?>
                
    </table>
    </div>
        <!--Content End-->
        
<?php include('partials/footer.php');?>  