<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change passowrd</h1>
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
                    <td>Current Passoword </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Old password">
                    </td>
                </tr>
                <tr>
                    <td>New Passoword </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Passoword </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                    <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary" >
                    </td>
                </tr>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        //get data here from form
        $id=$_POST['id'];
        $current_password=$_POST['current_password'];
        $new_password=$_POST['new_password'];
        $confirm_password=$_POST['confirm_password'];

        //check wheather user id with current password is exist or not
        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //execute query 
        $res=mysqli_query($conn, $sql);

        if($res==true)
        {
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                if($new_password==$confirm_password)
                {
                    //echo "pasw match";
                    //update password
                    $sql2="UPDATE `tbl_admin` SET `password` = '$new_password' WHERE `tbl_admin`.`id` = '$id'
                      ";

                    //execute query 
                    $res2=mysqli_query($conn, $sql2);
                    //check query exuted or not
                    if(res2==true)
                    {
                        $_SESSION['change-pwd']="<div class='success'>Password Changed successfully.</div>";
                        //redirect to admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['change-pwd']="<div class='error'>Failed to Change password.</div>";
                        //redirect to admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else{
                    $_SESSION['pwd-not-match']="<div class='error'>Password Did not matched.</div>";
                        //redirect to admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['user-not-found']="<div class='error'>User not found</div>";
                //redirect to admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }

?>

<?php include('partials/footer.php'); ?>
