<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1><br><br><br>

        <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset( $_SESSION['update'] );
            }
        ?><br><br>
            
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>

                <?php
                    // get the orders from database
                    $sql="SELECT * FROM tbl_order ORDER BY id DESC";

                    // execute the query
                    $res=mysqli_query($conn,$sql);

                    // count the rows
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0)
                    {
                        // order avilable
                        while($row=mysqli_fetch_assoc($res))
                        {
                            // get the order details
                            $id=$row['id'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $tot=$row['total'];
                            $odate=$row['order_date'];
                            $status=$row['status'];
                            $cust_name=$row['customer_name'];
                            $cust_contact=$row['customer_contact'];
                            $cust_email=$row['customer_email'];
                            $cust_address=$row['customer_address'];
                            
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td>₹<?php echo $price; ?></td>
                                <td><?php  echo $qty; ?></td>
                                <td>₹<?php echo $tot; ?></td>
                                <td><?php echo $odate; ?></td>
                                <td>
                                    <?php 
                                    if($status=="Ordered")
                                    {
                                        echo "<label>$status</label>";
                                    }
                                    else if($status=="On Delivery")
                                    {
                                        echo "<label style='color:orange;'>$status</label>";
                                    }
                                    else if($status=="Delivered")
                                    {
                                        echo "<label style='color:green;'>$status</label>";
                                    }
                                    else if($status=="Cancelled")
                                    {
                                        echo "<label style='color:red;'>$status</label>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $cust_name ?></td>
                                <td><?php echo $cust_contact ?></td>
                                <td><?php echo $cust_email ?></td>
                                <td><?php echo $cust_address ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update Order</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        // order not available
                        echo "<tr><td colspan='12' class='error'>Orders Not Available</td></tr>";
                    }
                ?>
                
            </table>
    </div>
</div>

<?php
    include('partials/footer.php');
?>