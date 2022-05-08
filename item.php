<?php include('partials-front/menu.php'); ?>

    <!-- item sEARCH Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">
            
            <form action="item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Item.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Item sEARCH Section Ends Here -->

    

          <!-- Item menu Section start Here -->
  
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Item Menu</h2>

            <?php
            //Display items that are active
            $sql = "SELECT * FROM tbl_item WHERE active='Yes' ";
            //Execute the query
            $res = mysqli_query($conn, $sql);
            //check whether the items are available or not
            $count = mysqli_num_rows($res);

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
                    ?><div class="item-menu-box">
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
//item not available
echo "<div class='error'>Item not Available.</div>";
}



?>


            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Items</a>
        </p>
    </section>

    <?php include('partials-front/footer.php'); ?>