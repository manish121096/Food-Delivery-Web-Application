<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Displaying session massage
                unset($_SESSION['add']);//Removing session massage
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];//Displaying session massage
                unset($_SESSION['upload']);//Removing session massage
            }
        ?>
        <br><br>
            <!-- add category form start -->
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Tittle:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                    <td colspan="2">
                       
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary" >
                    </td>
                    </tr>
                </table>
            </form>
             <!-- add category form end -->
            
             <?php

                //checked wheather submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get the value from category
                    $title=$_POST['title'];

                    //for radio input, we need to check wheather the button is selected or not
                    if(isset($_POST['featured']))
                    {
                        //get the value from form
                        $featured=$_POST['featured'];

                    }
                    else
                    {
                        //set the default value
                        $featured="No";
                    }
                    if(isset($_POST['active']))
                    {
                        //get the value from form
                        $active=$_POST['active'];

                    }
                    else
                    {
                        //set the default value
                        $active="No";
                    }
                    
                    //check wheather the image is selected or not and set the value for image name accordingly.
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name=$_FILES['image']['name'];
                        
                        //upload image if imageis selected
                        if($image_name!="")
                        {
                            //Auto rename the image
                            //get the extension of our image (jpg, png, gif etc.) "food1.jpg"
                            $ext=end(explode('.',$image_name));

                            //rename the image
                            $image_name="food_category_".rand(000, 999).'.'.$ext;//food_category_834.jpg

                            $source_path=$_FILES['image']['tmp_name'];

                            $destination_path="../images/category/".$image_name;

                            //finally upload the image
                            $upload=move_uploaded_file($source_path, $destination_path);

                            //check wheather image is uploaded or not
                            //and image is not uploaded then we will stop the processs and redirect with error message

                            if($upload==false)
                            {
                                //set message
                                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                //redirect to add category page
                                header('location:'.SITEURL.'admin/add-category.php');
                                //stop process
                                die();
                            }
                        }    
                    }
                    else
                    {
                        $image_name="";
                    }
                    //create sql query to insert a category into database
                    $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

                    //execute the query to save in tothe database
                    $res=mysqli_query($conn, $sql);
                    //check the wheather query is executed or not
                    if($res==true)
                    {
                        //query executed and ccategory added
                        $_SESSION['add']="<div class='success'>Category added successfully.</div>";
                        //redirect to admin page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        $_SESSION['add']="<div class='error'>Fail to add Category.</div>";
                        //redirect to admin page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                }
                
             ?>
        </div>
    </div>

<?php include('partials/footer.php'); ?>