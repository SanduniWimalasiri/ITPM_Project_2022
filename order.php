<?php include('partial-front/menuF.php');?>

<?php
    //Chech whether item id is set or not
    if(isset($_GET['Item_No']))
    {
        //Get the item id and the details of the selected food
        $item_id = $_GET['Item_No'];

        //Get the details of the elected food
        $sql = "SELECT * FROM item WHERE Item_No=$item_id";

        //Execute the query
        $res = mysqli_query($conn,$sql);

        //Count rows to check whether Items are in tha table
        $count = mysqli_num_rows($res);

        //Check whether the data is available or not
        if($count==1)
        {
            //Get the data from database
            $row = mysqli_fetch_assoc($res);
            $title = $row['Title'];
            $price = $row['Price'];
            $image_name = $row['Select_Image'];

        }
        else
        {
            //Redirect to home page
            header('location:'.SITEURL);
        }
    }
    else
    {
        //Redirect to home page
        header('location:'.SITEURL);
    }
?>
      
    <!--Form Content Start-->
    <section class="item-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order</h2>
            <form action="" method="POST" class="form">
                <!--Starting of the 1st section-->
                
                <fieldset class="c">
                    <legend>Selected Item</legend>

                                  
                <div class="item-img">

                <?php
                    //Check whether the image is available or not
                    if($image_name=="")
                    {
                        echo "<div class='error'>Image Not Available</div>";
                    }
                    else
                    {
                        ?>

                        <img src="images/<?php echo $image_name;?>" 
                        alt="Televission" class="curve" height="100%" width="100%">
                        <?php
                    }
                ?>
                                                             
                </div>
                <div class="item-desc">
                    
                    <h3><?php echo $title;?></h3>
                    <input type="hidden" name="item" value="<?php echo $title;?>">

                    <p class='item-price'>Rs.<?php echo $price;?></p>
                    <input type="hidden" name="price" value="<?php echo $price;?>">

                    <div class="label">Quantity</div>
                    <input type="number" name="qty" class="input-res" value="1" required>
                </div>
            </fieldset>
            
            <!--Ending of the 1st section-->

            <!--Starting of the second section-->
            <fieldset class="c">
                <legend>Customer Details</legend>

            <div>
                <div class="label">Customer Name</div>
                    <input type="text" name="cus-name" placeholder="E.g. Tharaka Silva" class="input-res" required>

                    <div class="label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +94xxxxxxxxx" class="input-res" required>

                    <div class="label">Email</div>
                    <input type="email" name="email" placeholder="E.g. tharaka@gmail.com" class="input-res" required>

                    <div class="label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City" class="input-res" required>
                    </textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="button button1">
            </div>
            </fieldset>
            <!--Ending of the second section-->
            </form>

            <?php
                //Check whether the submit button is checked or not
                if(isset($_POST['submit']))
                {
                    //Get details from the form
                    $item = $_POST['item'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "ordered";
                    $customer_name = $_POST['cus-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //Save the data in the database
                    //Cretate SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET
                        item = '$item',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        ";
                    //echo $sql2;
                        //Execute the query
                        $res2 = mysqli_query($conn,$sql2);

                        //Check whether the query executed successfully
                        if($res2 == true)
                        {
                            $_SESSION['order'] = "<div class='success'>Order Placed Successfully</div>";
                            header('location:'.SITEURL);
                        }
                        else
                        {
                            $_SESSION['order'] = "<div class='error'>Order Failed</div>";
                            header('location:'.SITEURL);
                        }
                }
            ?>
                        
        </div>

    </section>
    <!--Form Content End-->
      
<?php include('partial-front/footerF.php');?>

    
