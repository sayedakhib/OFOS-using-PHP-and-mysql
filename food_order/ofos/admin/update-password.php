<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
         if(isset($_GET['id']))
         {
            $id=$_GET['id'];
         }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="curr_pass" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_pass" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_pass" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php
    // check whether the btn is clicked
    if(isset($_POST['submit']))
    {
        // echo "Clicked";
        // get data from form
        $id=$_POST['id'];
        $Curr_pass=md5($_POST['curr_pass']);
        $new_pass=md5($_POST['new_pass']);
        $conf_pass=md5($_POST['confirm_pass']);

        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$Curr_pass'";

        $res=mysqli_query($conn,$sql);

        if($res==true)
        {
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                // echo "user found";
                if($new_pass==$conf_pass)
                {
                    // update the password
                    $sql2="UPDATE tbl_admin SET
                    password='$new_pass'
                    WHERE id=$id
                    ";

                    $res2=mysqli_query($conn,$sql2);

                    if($res2==true)
                    {
                        $_SESSION['change-pass']="<div class='success'>Password Changed Successfully.</div>";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }
                    else
                    {
                        $_SESSION['change-pass']="<div class='error'>Password Did Not Match.</div>";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }
                }
                else
                {
                    // redirect to manage-admin with error message
                    $_SESSION['pass-not-match']="<div class='error'>Password Did Not Match.</div>";
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }
            else
            {
                $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }
    }
?>

<?php include('partials/footer.php');?>