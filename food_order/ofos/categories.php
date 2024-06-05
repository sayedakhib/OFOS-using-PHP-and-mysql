<?php include('partials-front/menu.php')?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //create sql query to display all the categories from database
                $sql="SELECT * FROM tbl_category
                WHERE active='Yes'"; 

                //execute the query
                $res=mysqli_query($conn,$sql);
                //count rows to check whther data is present or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    //available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                            <a href="category-foods.php">
                            <div class="box-3 float-container">
                                <?php
                                  if($image_name=="")
                                  {
                                    //not available
                                    echo "<div class='error'>Image Not Found</div>";
                                  }
                                  else
                                  {
                                    //avilable
                                    ?>
                                     <img src="<?php echo SITEURL; ?>images/category/<?php echo "$image_name"; ?> " alt="Pizza" class="img-responsive img-curve">

                                    <?php
                                  }
                                ?>
            
                                <h3 class="float-text text-white"><?php echo "$title"; ?></h3>
                            </div>
                        </a>

                        <?php

                    }
                }
                else
                {
                    //not available
                    echo "<div class='error'>Category Not Found</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php')?>