<?php include('partials/menu.php');?>

        <?php

        //check wheather id is pass or not
        if(isset($_GET['category_id']))
        {
            //category id is set or get the id
            $category_id=$_GET['category_id'];
            //get the category title based on category id
            $sql="SELECT * FROM tbl_category WHERE id=$category_id";
            //execute the query
            $res=mysqli_query($conn, $sql);
            //get the value form database
            $row=mysqli_fetch_assoc($res);
            //get the title
            $category_title=$row['title'];
        }
        else
        {
            //categroy not pass
            header('location:'.SITEURL);
        }
        ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //create sql query to display food from database
                $sql2="SELECT * FROM tbl_food WHERE  category_id=$category_id";
                //execute the query
                $res2=mysqli_query($conn, $sql2);
                //count rows to check wheather foodes is available
                $count2=mysqli_num_rows($res2);
                if($count2>0)
                {
                    //food available
                    while ($row=mysqli_fetch_assoc($res2))
                     {
                        //set the value like id,title,image
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        $active=$row['active'];

                        ?>
                                    
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                                if($image_name=="")
                                {
                                        echo "<div class='error'>Image is not available</div>";
                                }
                                else
                                {
                                    ?>
                                         <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" alt="Recommended " class="img-responsive img-curve">  
                                    <?php 
                                }
                            ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">Rs. <?php echo $price ;?></p>
                                    <p class="food-detail"><?php echo $description; ?></p>
                                    <p class="food-price">Available: 
                                        <?php 
                                            if($active=="Yes")
                                            {
                                                echo "<lable style='color:green;'>$active</lable>";
                                            }
                                            elseif($active=="No")
                                            {
                                                echo "<lable style='color:red;'>$active</lable>";
                                            }
                                        ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }
                }
                else 
                {
                    //food not avialable
                    echo "<div class='error'> Food is not available right now.</div>";    
                }
            ?>

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials/footer.php');?>