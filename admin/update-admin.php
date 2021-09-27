<?php include('partials/menu.php')
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br/>
        <br/><br/><br/>

    <?php
        //1. get the id of admin to be deleted
        $id=$_GET['id'];

        //2. create sql query to delete admin
        $sql= "SELECT FROM tbl_admin WHERE id=$id";

        //3. Execute the query
        $res=mysqli_query($conn, $sql);

        // check wheather query executed successfully or not
        if($res==true)
        {
            //Check wheather the data is available or not
            $count=mysqli_num_rows($res);
            //check wheather admin data or not
            if($count==1)
            {
                //get the detail
                $row=mysqli_fetch_assoc($res); 

                $full_name=$row['full_name'];
                $username=$row['username'];
            }
            else
             {
                 //redirect the page
                 header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>" >
                    </td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary" >
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
 if(isset($_POST['submit']))
 {
     //create  all value for update 
     $id=$_POST['id'];
     $full_name=$_POST['full_name'];
     $username=$_POST['username'];

     //Create a sql query to update admin
     $sql="UPDATE tbl_admin SET 
     full_name='$full_name',
     username='$username'
     WHERE id='$id'
     "; 
    //3. Execute the query
        $res=mysqli_query($conn, $sql);

        // check wheather query executed successfully or not
        if($res==true)
        {
            //query executed successfully and admin deleted
            //create session to variable to display message
            $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
            //redirect to admin page
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
        else
        {
            $_SESSION['update']="<div class='error'>Failed to update admin</div>";
            //redirect to admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

 }

?>


<?php include('partials/footer.php')
?>
