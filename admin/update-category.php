<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <!-- add category form start -->

            <?php
                //check wheather id is set or not
                if(isset($_GET['id']))
                {
                    //get the id and all other detail
                    $id=$_GET['id'];
                    //create sql queyy to get all other deatil
                    $sql="SELECT * FROM tbl_category WHERE id=$id";

                    //execute the query
                    $res=mysqli_query($conn, $sql);

                    //count the row check wheather id is valid or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //get all data
                        $row=mysqli_fetch_assoc($res);
                        $title=$row['title'];
                        $current_image=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];

                    }
                    else
                    {
                        //redirect the page with session message
                        $_SESSION['no-category-found']="<div class='error'>Category not found.</div>";
                        //redirect to admin page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
                else
                {
                    //redirect to admin page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Tittle:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title;?>" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($current_image=="")
                                {
                                    //display image
                                    echo "<div class='error'>Image not added</div>"; 
                                }
                                else
                                {
                                   //display message
                                   ?>
                                   <img src="<?php echo SITEURL;?>/images/category/<?php echo $current_image?>" width="100">
                                    <?php
                                   
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                    <td colspan="2">
                       
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary" >
                    </td>
                </table>
            </form>
             <!-- add category form end -->

             <?php
                if(isset($_POST['submit']))
                {
                    //get all value from our form
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $current_image=$_POST['current_image'];
                    $featured=$_POST['featured'];
                    $active=$_POST['active'];

                    //updating image if selected
                    //checked wheather image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image detail
                        $image_name=$_FILES['image']['name'];
                        //check wheather image is avialable or not
                        if($image_name!="")
                        {
                            //image available
                            //upload new image
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
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    //stop process
                                    die();
                            }
                            //checked if image is availabe
                            if($current_image!="")
                            { 
                                //remove the current image
                                $remove_path="../images/category/".$current_image;

                                $remove=unlink($remove_path);
                                //check wheather image is removed or not
                                //if failed display a message and stop process
                                if($remove==false)
                                {
                                    //failed to rmove  image
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove image.</div>";
                                    header('locaton'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name=$current_image;
                    }

                    //update database
                    $sql2="UPDATE tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                    ";
                    //execute query
                    $res2=mysqli_query($conn, $sql2);

                    //redirect the category with mesage
                    //checked wheather executed or not
                    if($res2==true)
                    {
                        $_SESSION['update']="<div class='success'>Updated successfully</div>";
                        //redirect to add category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        $_SESSION['update']="<div class='error'>Failed to update category</div>";
                        //redirect to add category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
             ?>
            
        </div>
    </div>

<?php include('partials/footer.php'); ?>