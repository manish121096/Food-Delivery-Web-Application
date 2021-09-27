<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update food</h1>
            <!-- add food form start -->

            <?php
                //check wheather id is set or not
                if(isset($_GET['id']))
                {
                    //get the id and all other detail
                    $id=$_GET['id'];
                    //create sql queyy to  get all other deatil
                    $sql2="SELECT * FROM tbl_food WHERE id=$id";

                    //execute the query
                    $res2=mysqli_query($conn, $sql2);

                        //get all data
                        $row2=mysqli_fetch_assoc($res2);
                        $title=$row2['title'];
                        $description=$row2['description'];
                        $price=$row2['price'];
                        $current_image=$row2['image_name'];
                        $current_category=$row2['category_id'];
                        $featured=$row2['featured'];
                        $active=$row2['active'];                   
                }
                else
                {
                    //redirect to admin page
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr> 
                        <td>Tittle:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title;?>" >
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description"  cols="25" rows="5" ><?php echo $description;?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price;?>" >
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($current_image=="")
                                {
                                    echo "<div class='error'>Image not added</div>";
                                }
                                else
                                {
                                   //display message
                                   //display image
                                   ?>
                                   <img src="<?php echo SITEURL;?>/images/food/<?php echo $current_image?>" width="100">
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
                        <td>Category:</td>
                        <td>
                            <select name="category" >
                                <?php

                                    //create php code to display category form database
                                    //Create sql to get all the active category from databse
                                    $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                    //execute sql query
                                    $res=mysqli_query($conn, $sql);

                                    //count rows wheather we have category or not
                                    $count=mysqli_num_rows($res);

                                    //if count is greater then zero we have category else we have not
                                    if($count>0)
                                    {
                                        //we have category
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get the detail of category
                                            $category_id=$row['id'];
                                            $category_title=$row['title'];
                                            
                                            ?>
                                                <option <?php if($current_category==$category_id)echo "selected";?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //we do not have category
                                        ?>
                                        <option value="0">No category found</option>
                                        <?php
                                    }
                                ?>
                                
                            </select>
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
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update food" class="btn-secondary" >
                    </td>
                </table>
            </form>
             <!-- add food form end -->

             <?php
                if(isset($_POST['submit']))
                {
                    //get all value from our form
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $current_image=$_POST['current_image'];
                    $category=$_POST['category'];
                    $featured=$_POST['featured'];
                    $active=$_POST['active'];

                    //updating image if selected
                    //checked wheather image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image detail
                        $image_name=$_FILES['image']['name'];
                        //check wheather image is avialable or not
                        if($image_name !="")
                        {
                            //image available
                            //upload new image
                            //Auto rename the image
                            //get the extension of our image (jpg, png, gif etc.) "food1.jpg"
                            $ext=end(explode('.', $image_name));

                            //rename the image
                            $image_name="food_food_".rand(000, 999).'.'.$ext;//food_food_834.jpg

                            $source_path=$_FILES['image']['tmp_name'];

                            $destination_path="../images/food/".$image_name;

                            //finally upload the image
                            $upload=move_uploaded_file($source_path, $destination_path);

                            //check wheather image is uploaded or not
                            //and image is not uploaded then we will stop the processs and redirect with error message

                            if($upload==false)
                            {
                                    //set message
                                    $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                    //redirect to add food page
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    //stop process
                                    die();
                            }
                            //checked if image is availabe
                            if($current_image!="")
                            { 
                                //remove the current image
                                $remove_path="../images/food/".$current_image;

                                $remove=unlink($remove_path);
                                //check wheather image is removed or not
                                //if failed display a message and stop process
                                if($remove==false)
                                {
                                    //failed to rmove  image
                                    $_SESSION['remove-failed']="<div class='error'>Failed to remove current image.</div>";
                                    header('locaton'.SITEURL.'admin/manage-food.php');
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
                    $sql3="UPDATE tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                    ";
                    //execute query
                    $res3=mysqli_query($conn, $sql3);

                    //redirect the food with mesage
                    //checked wheather executed or not
                    if($res3==true)
                    {
                        $_SESSION['update']="<div class='success'>Updated successfully</div>";
                        //redirect to add food page
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        $_SESSION['update']="<div class='error'>Failed to update food</div>";
                        //redirect to add food page
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
             ?>
            
        </div>
    </div>

<?php include('partials/footer.php'); ?>