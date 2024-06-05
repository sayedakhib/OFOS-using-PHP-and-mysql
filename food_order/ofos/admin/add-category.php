<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <?php
                if(isset($_SESSION['add']))
                {
                   echo $_SESSION['add'];
                   unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload']))
                {
                   echo $_SESSION['upload'];
                   unset($_SESSION['upload']);
                }
            ?>
            <br><br>
            <!-- add category form starts -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td clospan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- add category form ends -->

            <?php
                //check wether the submit btn is clicked or not
                if(isset($_POST['submit']))
                {
                    // echo "clicked";
                    // get the values from form
                    $title=$_POST['title'];
                    
                    // for radio input type we need to check wether the btn is selected or not
                    if(isset($_POST['featured']))
                    {
                        // get the value from form
                        $featured=$_POST['featured'];

                    }
                    else
                    {
                        // set the default value
                        $featured='No';
                    }

                    if(isset($_POST['active']))
                    {
                        // get the value from form
                        $active=$_POST['active'];
                    }
                    else
                    {
                        // set the default value
                        $active='No';
                    }

                    // check wether the img is selected or not and set the values for imgname accordingly
                    if(isset($_FILES['image']['name']))
                    {
                        // Upload the image
                        // to upload the img we need img name,source path and destination path
                        $img_name=$_FILES['image']['name'];
                        
                        // upload the image only if selected
                        if($img_name!="")
                        {
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
                                header("location:".SITEURL."admin/add-category.php");
                                die();
                            }
                       }
                    }
                    else
                    {
                        // dont upload image and set the image name value as blank
                        $img_name="";
                    }

                    // create the query to insert data into database
                    $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$img_name',
                    featured='$featured',
                    active='$active'
                    ";

                    // execute the query and save in database
                    $res=mysqli_query($conn,$sql);

                    if($res==TRUE)
                    {
                        // querry executed and category added
                        $_SESSION['add']="<div class='success'>Category Added Successfully!!!</div>";
                        // redirect to manage-category.php
                        header("location:".SITEURL."admin/manage-category.php");
                    }
                    else
                    {
                        // failed to add category
                        $_SESSION['add']="<div class='error'>Failed To Add Category!!!</div>";
                        // redirect to manage-category.php
                        header("location:".SITEURL."admin/add-category.php");
                    }
                }
            ?>
        </div>
    </div>

<?php include('partials/footer.php');?>