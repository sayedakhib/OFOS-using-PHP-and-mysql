<?php  
    // Authorization
    // check wether the user is logged in or not 
    if(!isset($_SESSION['user']))//if user session is set 
    {
        //the user is not loged in 
        // redirect to login page with message
        $_SESSION['no-login-msg']="<script type='text/javascript'> alert('Please Login To Access Admin Panel')</script>";
        header("location:".SITEURL."admin/login.php");
    }
?>