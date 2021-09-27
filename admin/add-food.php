<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>
            <?php
                 if(isset($_SESSION['upload']))
                 {
                     echo $_SESSION['upload'];//Displaying session massage
                     unset($_SESSION['upload']);//Removing session massage
                 }
            ?>
            <!-- add food form start -->
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Tittle:</td>
                        <td>
                            <input type="text" name="title" placeholder="food Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description"  cols="25" rows="5" placeholder="Description of food"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" >
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
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
                                            $id=$row['id'];
                                            $title=$row['title'];
                                            
                                            ?>
                                                <option value="<?php echo $id;?>"><?php echo $title;?></option>
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
                       
                        <input type="submit" name="submit" value="Add food" class="btn-secondary" >
                    </td>
                    </tr>
                </table>
            </form>
             <!-- add food form end -->

             <?php

                //checked wheather button is clicked or not
                if(isset($_POST['submit']))
                {
                    //add food in database


                    //get the data from form
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $category=$_POST['category'];
                    
                    //cheked wheather radio button is checked or not
                    if(isset($_POST['featured']))
                    {
                        $featured=$_POST['featured'];
                    }
                    else
                    {
                        $featured="No";
                    }
                    if(isset($_POST['active']))
                    {
                        $active=$_POST['active'];
                    }
                    else
                    {
                        $active="No";
                    }
                    //upload image if selected
                    //checked wheather image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name=$_FILES['image']['name'];
                        
                        //upload image if imageis selected
                        if($image_name!="")
                        {
                            //Auto rename the image
                            //get the extension of our image (jpg, png, gif etc.) "food1.jpg"
                            $ext=end(explode('.',$image_name));

                            //create new name for the image
                            $image_name="food_name_".rand(0000, 9999).'.'.$ext;//food_name_834.jpg

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
                                //redirect to add category page
                                header('location:'.SITEURL.'admin/add-food.php');
                                //stop process
                                die();
                            }
                        }    
                    }
                    else
                    {
                        $image_name="";
                    }

                    //insert data into database
                    $sql2="INSERT INTO tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                    ";

                    //execute the query
                    $res2=mysqli_query($conn, $sql2);
                    //check wheather data is inserted or not
                    if($res2==true)
                    {
                            //set message
                                $_SESSION['add']="<div class='success'>Added successfull</div>";
                                //redirect to add category page
                                header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //set message
                        $_SESSION['add']="<div class='error'>Fail to add food</div>";
                        //redirect to add category page
                        header('location:'.SITEURL.'admin/add-food.php');
                    }
                }
             ?>
    
        </div>
    </div>

<?php include('partials/footer.php') ?>