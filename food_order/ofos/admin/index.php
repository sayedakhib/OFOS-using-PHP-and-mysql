<?php
    include('partials/menu.php');
?>

    <!-- Main content section Starts -->
    <div class="main-content">
        <div class="wrapper"><br><br>
            <center><h1 style="font-size:65px;">DASHBOARD</h1></center><br><br>
            <br>
            <?php
                 if(isset($_SESSION['login']))
                 {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                 }
            ?>
            <br><br>
        
            <div class="col-4 text-center">

            <?php
                $sql="SELECT * FROM tbl_category";

                // execute query
                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);
            ?>
                <h1><?php echo $count; ?></h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
            <?php
                $sql2="SELECT * FROM tbl_food";

                // execute query
                $res2=mysqli_query($conn,$sql2);

                $count2=mysqli_num_rows($res2);
            ?>
                <h1><?php echo $count2; ?></h1>
                <br>
                Foods
            </div>
            <div class="col-4 text-center">
            <?php
                $sql3="SELECT * FROM tbl_order";

                // execute query
                $res3=mysqli_query($conn,$sql3);

                $count3=mysqli_num_rows($res3);
            ?>
                <h1><?php echo $count3; ?></h1>
                <br>
                Total Orders
            </div>
            <div class="col-4 text-center">
                <?php
                    // create sql query to get total revenue
                    $sql4="SELECT SUM(total) AS Total From tbl_order WHERE status='Delivered'";

                    // execute the query
                    $res4=mysqli_query($conn, $sql4);
                    
                    // get the values
                    $row4 = mysqli_fetch_assoc($res4); 
                    $revenue=$row4['Total'];
                ?>
                <h1>₹<?php 
                    if($revenue>0)
                    {
                        echo "$revenue";
                    }
                    else
                    {
                        echo "0.00";
                    }
                ?></h1>
                <br>
                Revenue Generated
            </div>
            <div class="clearfix">

            </div><br><br><br><br><br><br><br>
        </div>
    </div>
    <!-- Main content Section Ends -->

<?php
    include('partials/footer.php');
?>
