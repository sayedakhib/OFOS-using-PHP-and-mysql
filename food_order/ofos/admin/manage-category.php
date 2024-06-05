<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1><br><br><br>
        <?php
                if(isset($_SESSION['add']))
                {
                   echo $_SESSION['add'];
                   unset($_SESSION['add']);
                }

                if(isset($_SESSION['remove']))
                {
                   echo $_SESSION['remove'];
                   unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete']))
                {
                   echo $_SESSION['delete'];
                   unset($_SESSION['delete']);
                }

                if(isset($_SESSION['no-cat-found']))
                {
                   echo $_SESSION['no-cat-found'];
                   unset($_SESSION['no-cat-found']);
                }

                if(isset($_SESSION['update']))
                {
                   echo $_SESSION['update'];
                   unset($_SESSION['update']);
                }

                if(isset($_SESSION['upload']))
                {
                   echo $_SESSION['upload'];
                   unset($_SESSION['upload']);
                }

                if(isset($_SESSION['failed']))
                {
                   echo $_SESSION['failed'];
                   unset($_SESSION['failed']);
                }
        ?>
        <br><br><br>
            <!-- button to add  new admin-->
            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a><br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    // querry for fetching the data
                    $sql="SELECT * FROM tbl_category";
                    $res=mysqli_query($conn,$sql);

                    // count rows
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    // check wether we hve data in database
                    if($count>0)
                    {
                        // we hve data in Database
                        // get the data and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $img_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];

                            ?>
                                <tr>
                                   <td><?php echo $sn++; ?></td>
                                   <td><?php echo $title; ?></td>

                                   <td>
                                    <?php 
                                        // check wether img name is available or not
                                        if($img_name!="")
                                        {
                                            // Display The Image
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $img_name?>" width="100px">
                                            <?php
                                        }
                                        else
                                        {
                                            // Display The Message
                                            echo "<div class='error'>Image Not Added.</div>";
                                        }
                                    ?>
                                   </td>

                                   <td><?php echo $featured; ?></td>
                                   <td><?php echo $active; ?></td>
                                   <td>
                                      <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                                      <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $img_name;?>" class="btn-danger">Delete Category</a>
                                   </td>
                                </tr>
                            <?php

                        }
                    }
                    else
                    {
                        // we dont hve data
                        // we will display the msg inside table
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added</div></td>
                        </tr>
                        <?php
                    }
                ?>
                
            </table>
    </div>
</div>

<?php
    include('partials/footer.php');
?>