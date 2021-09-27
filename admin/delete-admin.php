<?php
//include constans.php file here
include('../config/constants.php');

//1. get the id of admin to be deleted
$id=$_GET['id'];

//2. create sql query to delete admin
$sql= "DELETE FROM tbl_admin WHERE id=$id";

//3. Execute the query
$res=mysqli_query($conn, $sql);

// check wheather query executed successfully or not
if($res==TRUE)
{
    //query executed successfully and admin deleted
    //create session to variable to display message
    $_SESSION['delete']="<div class='success'>Admin deleted successfully</div>";
    //redirect to admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
    $_SESSION['delete']="<div class='error'>Failed to delete admin</div>";
    //redirect to admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}

?>
