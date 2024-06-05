<?php
    // include constants file
    include('../config/constants.php');

    // echo "delete";
    // wethet the id and image_name is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // Get the value and delete
        // echo "Get value and delete";
        $id=$_GET['id'];
        $img_name=$_GET['image_name'];

        // Remove the physical image file if available
        if($img_name!="")
        {
            // image is available and remove it
            $path="../images/category/".$img_name;
            // remove the image
            $remove=unlink($path);

            // check wether the image has been deleted or not
            if($remove==false)
            {
                // Set the session message
                $_SESSION['remove']="<div class='error'>Failed To Remove Category Image</div>";
                // redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // stop the process
                die();
            }
        }
        // delete data from database
        $sql="DELETE FROM tbl_category WHERE id=$id";
        
        // execute the querry
        $res=mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            // querry executed successfully
            //echo "Category Deleted Sucessfully";
            //create teh session variable to display the msgfmt_parse_message
            $_SESSION['delete']="<div class='success'>Category Deleted Sucessfully.</div>";
            // redirect
            header("location:".SITEURL."admin/manage-category.php");
        }
        else
        {
            // failed to delete Admin
            //echo "Failed To Delete Category";
            $_SESSION['delete']="<div class='error'>Failed To Delete Category.Try Again Later.</div>";
            // redirect
            header("location:".SITEURL."admin/manage-category.php");
        }

        // redirect to manage-category page

    }
    else
    {
        // redirect to manage-category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>