<?php include('partials-front/menu.php'); ?>
    <!-- item search Section Starts Here -->
    <div>
            <h1 class="text-center">Plaza Treading</h1>
    </div>
    <section class="item-search text-center">
        <div class="container">
         
    
            <form action="<?php echo SITEURL;?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Items.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Item Search Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php 
                //create sql  query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured ='Yes' LIMIT 3";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count the rows to check whether the category is avaliable or not
                $count = mysqli_num_rows($res);

                if ($count > 0)
                {
                    //category is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get values id.title,image name

                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL;?>category-items.php">
                            <div class="box-3 float-container ">
                        
                                <?php
                                  //check whther the image_name is available or not
                                  if($image_name=="")
                                  {
                                      //display message
                                      echo "<div class='error'>Image Not Available </div>";
                                  }
                                  else
                                  {
                                      //image_name available
                                      ?>
                                      
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="mobile_phones" class="img-responsive img-curve">
                                    
                                      <?php
                                  }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title ?></h3>
                                
                            </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    //category is not available
                    echo "<div class= 'error'> Category Not Added </div>";
                }
            ?>
         
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Items</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
</body>
</html>