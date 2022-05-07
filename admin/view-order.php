<?php include('partials/menu.php');?>

<div class="main-content">
        <div class="wrapper">
            <h1>View Order</h1>
            <br><br>

            <?php
                //Check whether ID is set or not
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    //Get details based on ID
                    $sql = "SELECT * FROM tbl_order WHERE id=$id";
                    //Execute the query
                    $res = mysqli_query($conn,$sql);
                    //Count rows
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        $row = mysqli_fetch_assoc($res);
                        $id = $row['id'];
                        $item = $row['item'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                    }
                    else
                    {
                        header("location:".SITEURL."manage-order.php");
                    }
                }
                else
                {
                    header("location:".SITEURL."manage-order.php");
                }
            ?>

                <table class = "tbl-30">
                    <tr>
                        <td><b>Order ID</b></td>
                        <td><?php echo $id;?></td>
                    </tr>
                    <tr>
                        <td><b>Item Name</b></td>
                        <td><?php echo $item;?></td>
                    </tr>

                    <tr>
                        <td><b>Price</b></td>
                        <td>Rs.<?php echo $price;?></td>
                    </tr>

                    <tr>
                        <td><b>Qty<b></td>
                        <td><?php echo $qty;?></td>
                    </tr>

                    <tr>
                        <td><b>Total</b></td>
                        <td><?php echo $total;?></td>
                    </tr>

                    <tr>
                        <td><b>Order Date</b></td>
                        <td><?php echo $order_date;?></td>
                    </tr>

                    <tr>
                        <td><b>Customer Name</b></td>
                        <td><?php echo $customer_name;?></td>
                    </tr>

                    <tr>
                        <td><b>Customer Contact</b></td>
                        <td><?php echo $customer_contact;?></td>
                    </tr>

                    <tr>
                        <td><b>Customer Email</b></td>
                        <td><?php echo $customer_email;?></td>
                    </tr>

                    <tr>
                        <td><b>Customer Address</b></td>
                        <td><?php echo $customer_address;?></td>
                    </tr>

                    <tr>
                        <td><b>Status</b></td>
                        <td><?php echo $status;?></td>
                    </tr>

                    
                </table>

            
        </div>
</div>
<?php include('partials/footer.php');?>