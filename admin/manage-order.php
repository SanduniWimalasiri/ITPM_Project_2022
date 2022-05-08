<?php include('partials/menu.php');?>

<!--Content Start-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>
        </div>

        <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

        ?>
    
    <table class="tab">
        <tr>
            <th>No</th>
            <th>Order ID</th>
            <th>Item</th>
            
            <th>Qty</th>
            <th>Total</th>
            <th>Customer Name</th>
            <th>Customer Contact</th>
            <th>Actions</th>
        </tr>
            
        <?php
            //Get all the orders from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

            //Execute Query
            $res = mysqli_query($conn,$sql);

            //Count the rows
            $count = mysqli_num_rows($res);

            $sn = 1; //Create serial number

            if($count>0)
            {
                //Order Available
                while($row = mysqli_fetch_assoc($res))
                {
                    //Get order details
                    $id = $row['id'];
                    $item = $row['item'];
                    
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];

                    ?>

                    <tr>                                   
                        <td><?php echo $sn++;?>.</td>
                        <td><?php echo $id;?></td>
                        <td><?php echo $item;?></td>
                        
                        <td><?php echo $qty;?></td>
                        <td><?php echo $total;?></td>
                        <td><?php echo $customer_name;?></td>
                        <td><?php echo $customer_contact;?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>update-order.php?id=<?php echo $id;?>" class="btn-a">Update Order</a>
                            <a href="<?php echo SITEURL;?>view-order.php?id=<?php echo $id;?>" class="btn-d">View Order</a>
                            <a href="<?php echo SITEURL;?>delete-order.php?id=<?php echo $id;?>" class="btn-b">Delete Order</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                echo "<tr><td colspan='8' class='error'>Order not available</td></tr>";
            }
        ?>
                
    </table>

    <br><br>
    <a href="report.php" class="btn-c">Order Report</a>
    <br><br><br><br><br><br><br><br><br>
    </div>

    <!--Content End-->
    

<?php include('partials/footer.php');?>