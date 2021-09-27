<?php include('partials/menu.php')
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>
        <br/><br/><br/>
        

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter your username">
                    </td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" placeholder="Enter your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary" >
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php')
?>

<?php
//proces the value form and save it in database

//check wheather submit button is clicked or not

if(isset($_POST['submit']))
{
    // button clicked
   $full_name = $_POST['full_name'];
    $username = $_POST['username'];
   $password = $_POST['password']; //password encryption
 
   //sql queery to insert the data into database
   $sql = "INSERT INTO tbl_admin SET
   full_name='$full_name',
   username='$username',
   password='$password'
   ";

    //executing query and savving into database
    $res= mysqli_query($conn, $sql) or die(mysqli_error());
   //  check wheather query executed or not
   if($res==TRUE)
   {
       //Data inserted
       //echo "Data inserted";
      //create a start session to display message
        $_SESSION['add']="<div class='success'>Admin added successfully</div>";
        //redirect page manage admin page
        header("location:".SITEURL.'admin/manage-admin.php');
   }
   else
   {
      //create a start session to display message
      $_SESSION['add']="<div class='error'>Failed to add admin</div>";
      //redirect page manage admin page
      header("location:".SITEURL.'admin/add-admin.php');

   }
}

?>