<?php include('partials-front/menu.php'); ?>

    <!-- item sEARCH Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for item.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- item sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Items</h2>

            <?php
            //create sql query to display categories for database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' LIMIT 3";
            //Execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="category-items.html">
                    <div class="box-3 float-container">
                        <?php
                            if($image_name=="")
                            {
                                //display message
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="Fridge" class="img-responsive img-curve">

                            <?php
                            }
                        
                        
                        
                        
                        ?>
                            <h3 class="float-text text-white"><?php echo $title?>"</h3>
                        </div>
                    </a>

                    <?php
                }
            }
            else
            {
                //categories not available
                echo "<div class='error'>Category not added.</div>";
            }



            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- item MEnu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Item Menu</h2>
            <?php
            //create sql query to display categories for database
            $sql2 = "SELECT * FROM tbl_item WHERE active='Yes' LIMIT 6";
            //Execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count rows to check whether the category is available or not
            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
                //item available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get the id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                        <div class="item-menu-box">
                                        <div class="item-menu-img">

                                        <?php
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                
                            <img src="<?php echo SITEURL;?>images/item/<?php echo $image_name?>" alt="Fridge" class="img-responsive img-curve">

                            <?php
                            }
                        
                        
                        
                        
                        ?>

                                        </div>
                                
                                        <div class="item-menu-desc">
                                            <h4><?php echo $title;?></h4>
                                            <p class="item-price">Rs.<?php echo $price;?>.00</p>
                                            <p class="item-detail"><?php echo $description;?> </p>
                                            <br>

                                            <a href="order.html" class="btn btn-primary">Order Now</a>
                                        </div>
                                    </div>

                    <?php
                }
            }
            else
            {
                //categories not available
                echo "<div class='error'>Item not Available.</div>";
            }



            ?>



            <!-- ITEM -->
            
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Items</a>
        </p>
    </section>

            
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>