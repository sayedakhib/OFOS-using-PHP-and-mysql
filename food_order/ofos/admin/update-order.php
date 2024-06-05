<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
            // Check if id is set or not
            if(isset($_GET['id']))
            {
                // Get the details
                $id=$_GET[ 'id' ]; 

                $sql="SELECT * from tbl_order WHERE id=$id";

                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $food=$row['food'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $status=$row['status'];
                    $cust_name=$row['customer_name'];
                    $cust_contact=$row['customer_contact'];
                    $cust_email=$row['customer_email'];
                    $cust_address=$row['customer_address'];
                }
                else
                {
                    header("location:".SITEURL."/admin/manage-order.php");
                }
            }
            else
            {
                header("location:".SITEURL."/admin/manage-order.php");
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td>
                       <b><?php echo $food; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                       <b><?php echo $price; ?></b>
                    </td>
              </tr>
               <tr>
                   <td>Qty</td>
                   <td>
                       <input type="number" name="qty" value="<?php echo $qty; ?>">
                   </td>
               </tr>
               <tr>
                   <td>Status:</td>
                   <td>
                       <select name="status">
                           <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                           <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                           <option <?php if($status=="Delivered"){echo "selected";} ?>value="Delivered">Delivered</option>
                           <option <?php if($status=="Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Customer Name:</td>
                   <td>
                       <input type="text" name="cust_name" value="<?php echo $cust_name; ?>">
                   </td>
               </tr>
               <tr>
                   <td>Customer Contact:</td>
                   <td>
                       <input type="text" name="cust_contact" value="<?php echo $cust_contact; ?>">
                   </td>
               </tr>
               <tr>
                   <td>Customer Email:</td>
                   <td>
                       <input type="text" name="cust_email" value="<?php echo $cust_email; ?>">
                   </td>
               </tr>
               <tr>
                   <td>Customer Address:</td>
                   <td>
                       <textarea name="cust_address"  cols="30" rows="5"><?php echo $cust_address; ?></textarea>
                   </td>
               </tr>
               <tr>
                   <td colspan='2'>
                       <input type="hidden" name="id" value="<?php echo $id; ?>">
                       <input type="hidden" name="price" value="<?php echo $price; ?>">
                       <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                   </td>
               </tr>
           </table>
       </form>

       <?php
           if(isset($_POST['submit']))
           {
               // Update order details
                $id=$_POST['id'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $tot=$price*$qty;
                $status=$_POST['status'];
                $cust_name=$_POST['cust_name'];
                $cust_contact=$_POST['cust_contact'];
                $cust_email=$_POST['cust_email'];
                $cust_address=$_POST['cust_address'];

               $sql2="UPDATE tbl_order SET
                   qty= $qty,
                   total=$tot,
                   status='$status',
                   customer_name='$cust_name',
                   customer_contact='$cust_contact',
                   customer_email='$cust_email',
                   customer_address='$cust_address'
                   WHERE id=$id
               ";

               $res2=mysqli_query($conn,$sql2);

               if($res2==true)
               {
                   // Updated
                   $_SESSION['update']="<div class='success'>Order Details Updated Successfully.</div>";
                   header("location:".SITEURL."admin/manage-order.php");
               }
               else
               {
                   // Failed
                   $_SESSION['update']="<div class='error'>Failed to Update .</div>";
                   header("location:".SITEURL."admin/manage-order.php");
               }
           }
       ?>

   </div>
</div>

<?php
include('partials/footer.php');
?>