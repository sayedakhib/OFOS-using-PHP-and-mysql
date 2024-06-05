<?php
    include('partials/menu.php');
?>

    <!-- Main content section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1><br><br>

            <?php 
            // add message
             if(isset($_SESSION['add']))
             {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
             }

            //  delete message
             if(isset($_SESSION['delete']))
             {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
             }

            //  
            if(isset($_SESSION['update']))
             {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
             }
             if(isset($_SESSION['user-not-found']))
             {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
             }
             if(isset($_SESSION['pass-not-match']))
             {
                echo $_SESSION['pass-not-match'];
                unset($_SESSION['pass-not-match']);
             }
             if(isset($_SESSION['change-pass']))
             {
                echo $_SESSION['change-pass'];
                unset($_SESSION['change-pass']);
             }
            ?>
            <br><br><br>
            <!-- button to add  new admin-->
            <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php 
                // querry to get all admin 
                  $sql="SELECT * FROM tbl_admin";
                //   Execute the querry
                  $res=mysqli_query($conn,$sql);

                //   check wether the querry is executed of not

                  if($res==TRUE)
                  {
                    // count rows to check wether we have data in database
                    $count=mysqli_num_rows($res);

                    $sn=1; // create the var and assign the value
                    // check the num of rows
                    if($count>0)
                    {
                        // we have data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            // to get teh data from databse
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];


                            // display the values in table
                            ?>
                            <tr>
                                <td><?php echo $sn++;?>.</td>
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username;?></td>
                                <td>
                                  <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                  <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                  <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>
                            <?php

                        }
                    }
                    else
                    {
                        // we dont have dat in database
                        ?>
                            <tr>
                                <td clospan="4"><div class="error">No Admin Added</div></td>
                            </tr>
                        <?php
                    }
                  }
                ?>
            </table>
        </div><br><br><br><br><br><br><br><br><br><br>
    </div>
    <!-- Main content Section Ends -->

<?php
    include('partials/footer.php');
?>