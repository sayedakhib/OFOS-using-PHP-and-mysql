<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br><br>
        <?php 
             if(isset($_SESSION['add']))
             {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
             }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                    <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                    <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>

<?php
    // process the value from form and save into database
    // check wether the button is clicked or not
    if(isset($_POST['submit']))
    {
        // button clicked
        // echo "button clicked";

        // get the data from form
        $full_name= $_POST['full_name']  ;
        $username =$_POST['username'];
        $password=md5($_POST['password']); //Encryption of password

        // sql querry to save the data into database 
        $sql= "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        
        // Execute querry and save data in database
        $res=mysqli_query($conn, $sql) or die(mysqli_error());

        // check wether the data is inserted or not
        if($res==TRUE)
        {
            // data inserted
            // echo "DATA INSERTED";
            // create a session a variable
            $_SESSION['add']="<div class='success'>Successfully Added Admin</div>";
            // redirect page to add-admin.php
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // data not inserted
            // echo "faled ";
            // create a session a variable
            $_SESSION['add']="<div class='error'>Failed To Add Admin</div>";
            // redirect page to add-admin.php
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    
?>