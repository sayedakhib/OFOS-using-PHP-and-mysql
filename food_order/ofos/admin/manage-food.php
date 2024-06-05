<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1><br><br>

            <!-- button to add  new admin-->
            <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a><br><br><br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                unset($_SESSION['add']);
                }
    
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }

                if(isset($_SESSION['failed']))
                {
                    echo $_SESSION['failed'];
                    unset($_SESSION['failed']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
           ?>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    // create sql to get all the food 
                    $sql="SELECT * FROM tbl_food";

                    // execute the querry
                    $res=mysqli_query($conn,$sql);

                    // count row to check whether we have food or not
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0)
                    {
                        // we have food in database
                        // get the food from database and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            // get the values from individual columns
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $img_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            
                            ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td><?php echo $price;?></td>
                                    <td>
                                    <?php 
                                        // check wether img name is available or not
                                        if($img_name!="")
                                        {
                                            // Display The Image
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $img_name?>" width="100px">
                                            <?php
                                        }
                                        else
                                        {
                                            // Display The Message
                                            echo "<div class='error'>Image Not Added.</div>";
                                        }
                                    ?>
                                    </td>
                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                    <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                       <a href="<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $img_name; ?>"class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        // food not added in database
                        echo "<tr> <td colspan='7' class='error'>Food Not Added YEt</td> </tr>";
                    }
                ?>
            </table>
    </div>
</div>

<?php
    include('partials/footer.php');
?>