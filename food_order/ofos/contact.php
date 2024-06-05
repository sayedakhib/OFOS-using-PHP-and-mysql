<?php include('partials-front/menu.php')?>
  <div class="box text-center" style="border: 1px solid grey;
    width: 40%;
    margin: 7% auto;
    background-color: #ffffff;
    box-shadow:2px #747d8c;
    padding: 2%;
    border-radius: 10px;">
   <h1 style="color: #ff6b81">Contact Us</h1><br>
   <?php
     if(isset($_SESSION['msg']))
     {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
     }
   ?>
   <form action="" method="POST">
     <p>Enter Name:</p><br>
     <input type="text" name="name" class="box-inp" style=" width: 80%;
    height: 25px;
    border-radius: 10px;" placeholder="Enter Your Name...."><br><br>

     <p>Enter Email:</p><br>
     <input type="email" name="email" style=" width: 80%;
    height: 25px;
    border-radius: 10px;" class="box-inp" placeholder="Enter Your Email...."><br><br>

     <p>Message:</p><br>
     <textarea name="msg" id="" cols="57" rows="5" style="border-radius: 10px;" placeholder="Message...."></textarea><br><br>

     <input type="submit" name="submit" style="background-color: #ff6b81;
    padding: 1%;
    color: white;
    text-decoration: none;
    font-weight: bold; width: 50%; height: 35px;
    border-radius: 5px;
    " value="Send Message">
   </form>

    <?php
      if (isset($_POST['submit']))
      {
        $name= $_POST["name"];
        $email= $_POST["email"];
        $msg= $_POST["msg"];

        // query to insert values in tbl_contact
        $sql="INSERT INTO tbl_contact SET
         name='$name',
         email='$email',
         message='$msg'
        ";
        
        // execute the query
        $res=mysqli_query($conn,$sql);

        // check if the query is executed or not
        if($res==true)
        {
            // data inserted
            $_SESSION['msg']="<div class='success text-center'>Message Sent.</div>";
            header("location:".SITEURL."contact.php");
        }
        else
        {
            // data not inserted
            $_SESSION['msg']="<div class='error text-center'>Message Not Sent.</div>";
            header("location:".SITEURL."contact.php");
        }
      }
    ?>

  </div>

<?php include('partials-front/footer.php')?>