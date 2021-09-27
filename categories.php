<?php include('partials/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- category Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php
                //create sql query to display category from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'";
                //execute the querys
                $res=mysqli_query($conn, $sql);
                //count rows to check wheather categories is available
                $count=mysqli_num_rows($res);
                if($count>0)
                {
                    //category available
                    while ($row=mysqli_fetch_assoc($res))
                     {
                        //set the value like id,title,image
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                            <?php
                                if($image_name=="")
                                {
                                        echo "<div class='error'>Image is not available</div>";
                                }
                                else
                                {
                                    ?>
                                         <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="Recommended " class="img-responsive img-curve">  
                                    <?php
                                }
                            ?>
                         

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                            </a>

                        <?php
                    }
                }
                else {
                    //category not avialable
                    echo "<div class='error'> Category is not available.</div>";
                }
            ?>
            


            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Category Section Ends Here -->


    
    <?php include('partials/footer.php');?>