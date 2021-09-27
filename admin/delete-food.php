<?php

    //include consatants file
    include('../config/constants.php');

    //check wheather id name and image name value is set or not set
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete the value
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];


        //remove the physical image file is availabel
        if($image_name != "" )
        {
            //image available so remove it    
            $path="../images/food/".$image_name;
            //remove the image
            $remove=unlink($path);

            //if failed remove then add error message and stop
            if($remove==false)
            {
                //set the session message
                $_SESSION['upload']="<div class='error'>Failed to Remove food image</div>";
                //redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop process
                die();     
            }
        }
        //delete from database
        //sql query to delete image
        $sql="DELETE FROM tbl_food WHERE id=$id";
        //execute query
        $res=mysqli_query($conn, $sql);

        //check wheather data is deleted or not
        if($res==true)
        {
            //set success message and redirect
             $_SESSION['delete']="<div class='success'>Food Deleted successfully.</div>";
            //redirect to manage food page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //set failed message and redirect
            $_SESSION['delete']="<div class='error'>Failed to Delete food.</div>";
            //redirect to manage food page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        $_SESSION['unauthorize']="<div class='error'>Unauthorize Access</div>";
        //redirect the manage-food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    
?>