<?php include('partials-front/menu.php'); ?>

<section action="item-search.html"></section>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>

            <?php
                //display all the active categories
                //sql query
                $sql = "SELECT *FROM tbl_category WHERE active='Yes'";

                //execute the query
                $res = mysqli_query($conn,$sql);

                //count the rows
                $count =mysqli_num_rows($res);

                //check whether the category is available or not
                if($count>0)
                {
                    //category is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values
                        $id = $row['id'];
                        $title =$row['title'];
                        $image_name=$row['image_name'];

                        ?>
                        <a href="category-foods.html">
                        <div class="box-3 float-container" > 
                        <?php
                            if ($image_name=="")
                            {
                                //image is not available
                                echo"<div class='error'> Image Not Found </div>";
                            }
                            else
                            {
                                //image is avalable
                                ?>
                                     <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                       <h3 class="float-text text-white"><?php echo $title?></h3>
                        </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //category is not available
                    echo"<div class='error'> Category Not Found </div>";
                }

            ?>
        
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   <?php include('partials-front/footer.php');?>

</body>
</html>