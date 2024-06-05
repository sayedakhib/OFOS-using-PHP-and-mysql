<?php
    include('../config/constants.php');

    // 1.get the id of the admin to be deleted
    $id=$_GET['id'];
    
    // 2.create sql querry to delete teh admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";
    
    // execute the querry
    $res=mysqli_query($conn,$sql);

    // check wether the querry executed successfully or not
    // 3.redirect to manage admin
    if($res==TRUE)
    {
        // querry executed successfully
        //echo "Admin Deleted Sucessfully";
        //create teh session variable to display the msgfmt_parse_message
        $_SESSION['delete']="<div class='success'>Admin Deleted Sucessfully</div>";
        // redirect
        header("location:".SITEURL."admin/manage-admin.php");
    }
    else
    {
        // failed to delete Admin
        //echo "Failed To Delete Admin";
        $_SESSION['delete']="<div class='error'>Failed To Delete Admin.Try Again Later.</div>";
        // redirect
        header("location:".SITEURL."admin/manage-admin.php");
    }
    
?>