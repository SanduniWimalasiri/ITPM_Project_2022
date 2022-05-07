<?php include('partial-front/menuF.php');?>

    <!-- Item Section Starts Here -->
    
    <section class="item">
        <div class="container">
            <h2 class="text-center">Items</h2>

            <?php
                //Geting Items from database which are active
                //SQL Query
                $sql = 'SELECT * FROM item WHERE Available="yes" LIMIT 6';

                //Execute the query
                $res = mysqli_query($conn,$sql);
                
                //Count rows to check whether Items are in tha table
                $count = mysqli_num_rows($res);
                                
                //check whether item available or not
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['Item_No'];
                        $title = $row['Title'];
                        $price = $row['Price'];
                        $description = $row['Description'];
                        $image_name = $row['Select_Image'];
                        ?>

                        <div class="item-box">
                            <div class="item-img">
                                <?php
                                    //Check image availbale or not
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/<?php echo $image_name;?>" alt="Item Image" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="item-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="item-price"><?php echo $price;?></p>
                                <p class="item-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="order.php?Item_No=<?php echo $id;?>" class="btn-c">Order Now</a>
                            </div>
                        </div>
            
                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Item not available</div>";
                }
            
            ?>
            
            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Item Section Ends Here -->
    
<?php include('partial-front/footerF.php');?>