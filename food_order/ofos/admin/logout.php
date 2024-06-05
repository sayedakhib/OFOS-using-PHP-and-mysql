<?php
    include('../config/constants.php');
    // destroy the session and redirect to login page
    session_destroy(); //$_SESSION['user']
    header("location:".SITEURL."admin/login.php");
?>