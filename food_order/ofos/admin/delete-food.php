<?php
    // include constants file
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // process to delete
        // 1.Get the id and image name
        $id=$_GET['id'];
        $img_name=$_GET['image_name'];

        // 2.remove the image if available
        // check wether the image is available or not
        if($img_name != "")
        {
            // it has image and need to remove from folder
            // get the img path
            $path="../images/food/".$img_name;

            // remove image file from folder 
            $remove=unlink($path);

            if($remove==false)
            {
                $_SESSION['upload']="<div class='error'>Failed To Remove Image File</div>";
                header("location:".SITEURL."admin/manage-food.php");
                die();
            }
        }

        // 3.delete food from database
        $sql="DELETE FROM tbl_food WHERE id=$id";
        // execute the querry
        $res=mysqli_query($conn,$sql);

        // check wether executed or not
        if($res==true)
        {
            // food deleted
            $_SESSION['delete']="<div class='success'>Food Deleted Successfully</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
        else
        {
            // failed to delete food
            $_SESSION['delete']="<div class='error'>Failed To Delete Food</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
        // 4.redirect to manage food with msg
    }
    else
    {
        // redirect to manage food page
        $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }
?>