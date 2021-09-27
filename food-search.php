<?php include('partials/menu.php');?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        <?php 
           $search=$_POST['search'];
           
        ?>
             <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
            <br>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>
           

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //get  the search keyword
                $search=$_POST['search'];
                //sql query based on search keyword
                $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '$search' ";

                //execute the query
                $res=mysqli_query($conn, $sql);

                //count row
                $count=mysqli_num_rows($res);
                //check wheather row is availabel or not
                if($count>0)
                {
                    //food avialable
                    while ($row=mysqli_fetch_assoc($res))
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

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials/footer.php');?>