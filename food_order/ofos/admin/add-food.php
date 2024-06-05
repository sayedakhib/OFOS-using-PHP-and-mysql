<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
       <h1>Add Food</h1>
       <br><br>

       <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
       ?>

       <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
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
                                        $id=$row['id'];
                                        $title=$row['title'];

                                        ?>

                                             <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
       </form>

       <?php
            //check wether the btn is clicked or not
            if(isset($_POST['submit'])) 
            {
                // Add the food in database
                // echo "clicked";
                // 1.get the data from form
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];
                
                // check whether the radio btn for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured=$_POST['featured'];
                }
                else
                {
                    $featured="No";
                }

                if(isset($_POST['active']))
                {
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";
                }

                // 2.Upload the image if selected
                // check whether select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    // get the details of the selected image
                    $img_name=$_FILES['image']['name'];

                    // check whethre the image is selected or not and upload image only if selected
                    if($img_name!="")
                    {
                        // image is selected
                        // rename the image
                        $ext=end(explode('.',$img_name));

                        // create new name for image
                        $img_name="Food-Name-".rand(0000,9999).".".$ext;

                        // upload the image
                        // get the source path and dest path

                        // source path is the current location of the image
                        $src=$_FILES['image']['tmp_name'];

                        // dest path for the image to be uploaded
                        $dst="../images/food/".$img_name;

                        // finally upload the image
                        $upload = move_uploaded_file($src,$dst);

                        // check whether image uploaded or not
                        if($upload==false)
                        {
                            // failed to upload the image 
                            // redirect to add food page with error msg
                            $_SESSION['upload']="<div class='error'>Failed To Upload Image.";
                            header("Location:".SITEURL."admin/add-food.php");
                            die();
                        }
                    }
                }
                else
                {
                    $img_name="";
                }

                // 3.Insert into database

                $sql2="INSERT INTO tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$img_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'
                ";

                // execute the querry
                $res2=mysqli_query($conn,$sql2);
                // check whether data is inserted or not
                if($res2==true)
                {
                    // data inserted successfully
                    $_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }
                else
                {
                    // failed to insert data
                    $_SESSION['add']="<div class='error'>Failed To Food Add.</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }
            }
       ?>
    </div>
</div>


<?php include('partials/footer.php');?>