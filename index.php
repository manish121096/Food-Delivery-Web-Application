<?php include('partials/menu.php');?>

        <?php
            if(isset($_SESSION['order']))
            {
                echo $_SESSION['order'];//Displaying session massage
                unset($_SESSION['order']);//Removing session massage
            }
        ?>
    <section id="desc">
        <h1 class="h-primary">Welcome To Desi Dhaba</h1>
        

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- Service Section Starts Here -->
    <section class="service-container">
        <h1 class="hcenter">Our services</h1>
        <div id="services">
                <div class="box">
                    <img src="png/cat.png" alt="">
                    <h2 class="h-secondry">Food Catering</h2>
                    <p class="center" >Catering services for wedding - Service providers from India of catering services
                        for wedding party, Home Delivery Services(1196) ... Limited” is one of the leading
                        Service Provider of Catering Services,Food Catering Services more.</p>
                </div>
            <div class="box">
                    <img src="png/bfood.png" alt="">
                    <h2 class="h-secondry">Bulk Ordering</h2>
                    <p class="center">Order food in bulk, Order Desi Meals online from your favourate Nearby Dhaba to test your real indian food at your small house party and for office party...</p>
            </div>
            <div class="box">
                    <img src="png/del9.png" alt="" >
                    <h2 class="h-secondry">Food Delivering</h2>
                    <p class="center">Find your nearby Dhaba at your current anywhere you are. Just click here to get your nearby Dhaba and show there menu list and order your food get Delivery at your location and enjoy your the local test at your foot.
                    </p>
            </div>
        </div>
    </section>
    <!-- Service Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //create sql query to display food from database
                $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
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
            <a href="<?php SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   

   <?php include('partials/footer.php');?>