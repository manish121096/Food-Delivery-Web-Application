<?php include('../config/constants.php');?>

<html>
    <head>
        <title>
            Login || DesiDhaba
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];//Displaying session massage
                unset($_SESSION['login']);//Removing session massage
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];//Displaying session massage
                unset($_SESSION['no-login-message']);//Removing session massage
            }
        ?>
        <br><br>
            <!-- Login form -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter the username"><br><br>
                Password:<br>
                <input type="text" name="password" placeholder="Enter the password"><br><br>

                <input type="submit" name="submit" Value="Login" class="btn-primary"><br>
            </form>
        </div>

    </body>
</html>


<?php
    //checked whether submit button clicked or not
    if(isset($_POST['submit']))
    {
            $username=$_POST['username'];
            $password=$_POST['password'];
        // sql query to check wheather username or password exists or not
        $sql="SELECT * FROM tbl_admin  WHERE username='$username' AND password='$password'";

        //execute query
        $res=mysqli_query($conn, $sql);

        //count rows to chek wheater user exist or not

        
        $count=mysqli_num_rows($res);
        if($count==1)
        {
                //user availabel login success
                $_SESSION['login']="<div class='success'>Login Successfull</div>";
                $_SESSION['user']=$username;//To check witheat the user is loged in and logout will unset it.
                //redirect page manage admin page
            header("location:".SITEURL.'admin/');
         }
        else{
            //user availabel login fail
            $_SESSION['login']="<div class='error text-center' >Username and passowrd did not matched</div>";
            //redirect page manage admin page
            header("location:".SITEURL.'admin/login.php');
        }
    }


?>
