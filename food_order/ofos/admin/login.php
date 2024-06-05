<?php include('../config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="log-pge">
    <div class="login">
        <h1 class="text-center">Login</h1><br>
        

        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-msg']))
            {
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
            }
        ?>
        <br>

        <!-- login form starts here -->
        <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text"  class="log-inp" name="username" placeholder="Enter Username"><br><br>

            Password:<br>
            <input type="password"  class="log-inp" name="password" placeholder="Enter Password"><br><br>

            <input type="submit"  value="Login" name="submit" class="btn-primary sub-btn">
        </form>
        <!-- login form starts here -->
        
    </div>
</body>
</html>

<?php
    // check wether the submit btn is clicked or not
    if(isset($_POST['submit']))
    {
        // process for login
        // get the data from login form
        // $username=$_POST['username'];
        // $password=md5($_POST['password']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $raw_password=md5($_POST['password']);
        $password=mysqli_real_escape_string($conn,$raw_password);
        
        // create a sql to check wether username and password exist or not
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // execute the query
        $res=mysqli_query($conn,$sql);

        $count=mysqli_num_rows($res);

        if($count==1)
        {
            // user available
            $_SESSION['login']="<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user']=$username;//to check wether the user is logged in or not and logout will unset it

            // redirect to index.php
            header("location:".SITEURL."admin/");
        }
        else
        {
            // user not available
            $_SESSION['login']="<div class='error text-center'>Wrong Username and Password!!!</div>";
            // redirect to index.php
            header("location:".SITEURL."admin/login.php");
        }
    }
?>