<?php include('partials-front/menu.php'); ?>

<section class="item-search text-menu">
        <div class="container">
            <h2>Items on your search <a href="#" class="text-white"></a></h2>

        </div>
</section>







<!--item menu section start here-->
<section class="item-menu">
        <div class="container">
            <h2 class="text-center">Item Menu</h2>
   
            <?php
                //get all search keywords
                $search = $_POST['search'];

                //sql query to get items based on search keywords
                $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

                //execute the query
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether item available or not 
                if($count>0)
                {
                //item available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
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
                            //image  available or not
                            echo "<div class='error'>Image Not Available</div>";
                        }
                        else
                        {
                            //image available
                            ?>
                    
                        <img src="<?php echo SITEURL;?>images/item/<?php echo $image_name?>" alt="" class="img-responsive img-curve">

                        <?php
                        }
            
            
            
            
                    ?>
                    </div>
    





         
                <div class="item-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="item-price">Rs.<?php echo $price?>.00</p>
                    <p class="item-detail"><?php echo $description?></p>
                    <br>


                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                    <?php
                }

            }
            else
            {
                //item not available
                echo "<div class='error'>Item not found.</div>";
            }
        
            ?>
                    
                    



            <div class="clearfix"></div>

            

        </div>
        </section>



<?php include('partials-front/footer.php'); ?>