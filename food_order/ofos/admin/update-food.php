<?php include('partials/menu.php'); ?>

<?php
    // check wether id is set or not
    if(isset($_GET['id']))
    {
        // get all the details
        $id=$_GET['id'];

        // sql querry to get all details
        $sql2="SELECT * FROM tbl_food WHERE id=$id";
        // execute the query
        $res2=mysqli_query($conn,$sql2);

        // get the value
        $row2=mysqli_fetch_assoc($res2);

        $title=$row2['title'];
        $descripton=$row2['description'];
        $price=$row2['price'];
        $curr_image=$row2['image_name'];
        $curr_category=$row2['category_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];
    }
    else
    {
        // redirect to manage-food page
        header("location:".SITEURL."admin/manage-food.php");
    }
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $descripton; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>current Image: </td>
                    <td>
                    <?php
                        if($curr_image!="")
                        {
                            // display the image
                            ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $curr_image;?>" width="150px">
                            <?php
                        }
                        else
                        {
                            // display the message
                            echo "<div class='error'>Image Not Available.</div>";
                        }
                    ?> 
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >

                            <?php
                                // write php to display categories from database
                                // 1.create sql to get all active categories from database
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                // executing querry
                                $res=mysqli_query($conn,$sql);

                                // count rows to check wether we have categories or not
                                $count=mysqli_num_rows($res);

                                // if count is greater than 0 we have categories else we do nat hve categories
                                if($count>0)
                                {
                                    // we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // get the details of category
                                        $id1=$row['id'];
                                        $title=$row['title'];

                                        ?>

                                             <option <?php if($curr_category==$id1){echo "Selected";}?> value="<?php echo $id1; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    // we dont have categories
                                    ?>
                                        <option value="0">No Categories Found</option>
                                    <?php
                                }

                            ?>

                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "Checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="curr_image" value="<?php echo $curr_image;?>">
                        <input type="submit" name="submit" value="Update Food" class=btn-secondary>
                    </td>
                </tr>
                </table>

            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    // echo "clicked";
                    // get all the details from the form
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $curr_image=$_POST['curr_image'];
                    $category=$_POST['category'];
                    $featured=$_POST['featured'];
                    $active=$_POST['active'];

                    // upload the image if selected
                    // check wethter the upload btn is clicked or not
                    if(isset($_FILES['image']['name']))
                    {
                        // upload btn clicked
                        $img_name=$_FILES['image']['name'];

                        if($img_name!="")
                        {
                            // available
                            // rename the image
                            $ext=end(explode('.',$img_name));

                            $img_name="Food-Name-".rand(0000,9999).".".$ext;

                            $src_path=$_FILES['image']['tmp_name'];

                            $dest_path="../images/food/".$img_name;

                            // upload the img
                            $upload=move_uploaded_file($src_path,$dest_path);

                            // check wether the image is uploaded or not
                            if($upload==false)
                            {
                                $_SESSION['upload']="<div class='error'>Failed To Upload New Image.</div>";
                                header("location:".SITEURL."admin/manage-food.php");
                                die();
                            }
                        
                            // remove the image if new image is uploaded and curr image exist
                            // remove the current image
                            if($curr_image!="")
                            {
                                 $path="../images/food/".$curr_image;
                                 $remove=unlink($path);

                                 if($remove==false)
                                 {
                                     // failed to remove image
                                     $_SESSION['failed']="<div class='error'>Failed To Remove Current Image.</div>";
                                     header("location:".SITEURL."admin/manage-food.php");
                                     die();//stop the process
                                 }
                            }
                        }
                        else
                        {
                            $img_name=$curr_image;
                        }
                    }
                    else
                    {
                        $img_name=$curr_image;
                    }

                    // update the food in the database
                    $sql3="UPDATE tbl_food SET
                        title='$title',
                        description='$description',
                        price='$price',
                        image_name='$img_name',
                        category_id='$category',
                        featured='$featured',
                        active='$active'
                        WHERE id=$id
                    ";

                    // Execute the querry
                    $res3=mysqli_query($conn,$sql3);

                    if($res3==true)
                    {
                        // query executed and food updated
                        $_SESSION['update']="<div class='success'>Food Updated Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        // failed to update food
                        $_SESSION['update']="<div class='error'>Failed To Update Food.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }

                }
            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>