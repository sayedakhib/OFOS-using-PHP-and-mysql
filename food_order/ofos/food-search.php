<?php include('partials-front/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                //  get the search keyword
                $search=mysqli_real_escape_string($conn,$_POST['search']);
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php
           
            // sql query to get food based on search keyword
            $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description  LIKE '%$search%'";
            // execute the query
            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);

            if($count>0)
            {
                // food available
                while($row=mysqli_fetch_assoc($res))
                {
                    // get the details
                    $id= $row["id"];
                    $title=$row[ "title"] ;
                    $price= $row["price"] ;
                    $descrip= $row["description"] ;
                    $image_name=$row[ "image_name"] ; 
                    ?>
                       <div class="food-menu-box">
                           <div class="food-menu-img">
                            <?php
                                // check wether the image is avilable or not
                                if($image_name == "")
                                {
                                    // image not available
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                    // image availble
                                    ?>
                                      <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                               
                           </div>
           
                           <div class="food-menu-desc">
                               <h4><?php echo $title; ?></h4>
                               <p class="food-price"><?php echo $title; ?></p>
                               <p class="food-detail">
                                  <?php echo $descrip; ?>
                               </p>
                               <br>

                               <a href="#" class="btn btn-primary">Order Now</a>
                           </div>
                       </div>
                         
                    <?php
                }
            }
            else
            {
                // food not available
                echo "<div class='error text-center'><h1>Food Not Found</h1></div>";
            }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>