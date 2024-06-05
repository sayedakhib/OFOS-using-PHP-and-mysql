<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1><br><br>

        <?php
            if(isset($_GET['id']))
            {
                // get the id and other details
                $id=$_GET['id'];
                // create a querry to get other details
                $sql="SELECT * FROM tbl_category WHERE id=$id";
                // execute the querry
                $res=mysqli_query($conn,$sql);

                // count the rows to check wether id is valid or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    // get the all the data
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $curr_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else
                {
                    // redirect to manage category
                    $_SESSION['no-cat-found']="<div class='error'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                // redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>


        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>
            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                        if($curr_image!="")
                        {
                            // display the image
                            ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $curr_image;?>" width="150px">
                            <?php
                        }
                        else
                        {
                            // display the message
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="featured" value="No"> No
                </td>
           </tr>
           <tr>
                <td>Active</td>
                <td>
                    <input <?php if($active=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "Checked";} ?> type="radio" name="active" value="No">No
                </td>
           </tr>
           <tr>
                <td clospan="2">
                    <input type="hidden" name="curr_image" value="<?php echo $curr_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
           </tr>
        </table>
        </form>

        <?php
            // check if btn is clicked or not
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // get all the values from form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $curr_image=$_POST['curr_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                // updating the image if selected
                // check wether the img is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $img_name=$_FILES['image']['name'];
                    // check wether the image is available or not
                    if($img_name!="")
                    {
                            // image available
                            // upload the new image
                            // Auto Rename our image
                            // Get the extension of our image (jpg,png etc)
                            $ext=end(explode('.',$img_name));

                            // rename the image
                            $img_name="Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_834.jpg

                            $source_path=$_FILES['image']['tmp_name'];

                            $dest_path="../images/category/".$img_name;

                            // upload the img
                            $upload=move_uploaded_file($source_path,$dest_path);

                            // check wether the image is uploaded or not
                            if($upload==false)
                            {
                                $_SESSION['upload']="<div class='error'>Failed To Upload Image.</div>";
                                header("location:".SITEURL."admin/manage-category.php");
                                die();
                            }
                            // remove the current image
                            $path="../images/category/".$curr_image;
                            $remove=unlink($path);

                            if($remove==false)
                            {
                                // failed to remove image
                                $_SESSION['failed']="<div class='error'>Failed To Remove Current Image.</div>";
                                header("location:".SITEURL."admin/manage-category.php");
                                die();//stop the process
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
                

                // update the database
                $sql2="UPDATE tbl_category SET
                     title='$title',
                     image_name='$img_name',
                     featured='$featured',
                     active='$active'
                     WHERE id=$id
                ";

                // execute the query
                $res2=mysqli_query($conn,$sql2);

                // redirect to manage-category
                if($res2==true)
                {
                    // category updated
                    $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // falied to update category
                    $_SESSION['update']="<div class='error'>Failed To Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>