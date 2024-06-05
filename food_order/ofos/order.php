<?php include('partials-front/menu.php')?>

    <?php
    // check wether food id is set or not
      if(isset($_GET['food_id']))
      {
        // get the food id and details of selected food
        $food_id=$_GET['food_id'];

        // get the details
        $sql="SELECT * FROM tbl_food WHERE id='$food_id'";

        // execute the query
        $res= mysqli_query($conn,$sql);

        //count the rows
        $count= mysqli_num_rows($res);
        
        if($count==1)
        {
            // we have data
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $img_name=$row['image_name'];
        }
        else
        {
            header("location:".SITEURL);
        }

      }
      else
      {
        // redirect to home page
        header( "location:".SITEURL); 
      }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($img_name=="")
                            {
                                // image not available
                                echo "<div class='error'>Image Not Available!</div>";
                            }
                            else
                            {
                                // image is available
                                ?>
                                  <img src="<?php echo SITEURL; ?>images/food/<?php echo $img_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">₹<?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Your Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. name@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    // get all the details from the form
                    $food= $_POST["food"];
                    $price= $_POST["price"];
                    $qty= $_POST["qty"];
                    $total= $price * $qty;
                    $order_date=date("y-m-d h:i:sa");
                    $status="Ordered";
                    $cust_name=$_POST['full-name'];
                    $cust_contact=$_POST['contact'];
                    $cust_email=$_POST['email'];
                    $cust_address=$_POST['address'];

                    // save the order in  database
                    // create sql to save data
                    $sql2="INSERT INTO tbl_order SET
                      food='$food',
                      price=$price,
                      qty=$qty,
                      total=$total,
                      order_date='$order_date',
                      status='$status',
                      customer_name= '$cust_name' ,
                      customer_contact= '$cust_contact' ,
                      customer_email= '$cust_email' ,
                      customer_address= '$cust_address'
                    ";

                    $res2=mysqli_query($conn,$sql2);
                    if($res2==true)
                    {
                        // querry executed
                        $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully.</div>";
                        header("location:".SITEURL);
                    }
                    else
                    {
                        // failed to save order
                        $_SESSION['order']="<div class='error text-center'>Failed to order food.</div>";
                        header("location:".SITEURL);
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php')?>