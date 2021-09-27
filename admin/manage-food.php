<?php include('partials/menu.php')
?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Food</h1>
        <br><br>  


        <?php
                 if(isset($_SESSION['add']))
                 {
                     echo $_SESSION['add'];//Displaying session massage
                     unset($_SESSION['add']);//Removing session massage
                 }
                 if(isset($_SESSION['delete']))
                 {
                     echo $_SESSION['delete'];//Displaying session massage
                     unset($_SESSION['delete']);//Removing session massage
                 }
                 if(isset($_SESSION['upload']))
                 {
                     echo $_SESSION['upload'];//Displaying session massage
                     unset($_SESSION['upload']);//Removing session massage
                 }
                 if(isset($_SESSION['unauthorize']))
                 {
                     echo $_SESSION['unauthorize'];//Displaying session massage
                     unset($_SESSION['unauthorize']);//Removing session massage
                 }
                 if(isset($_SESSION['update']))
                 {
                     echo $_SESSION['update'];//Displaying session massage
                     unset($_SESSION['update']);//Removing session massage
                 }
     
            ?>     

        <!-- button for add Food -->
        <br/><br/><br/>
        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title:</th>
                <th>Price</th>
 
                <th>Image</th>
                <th>Description</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

                //create sql query to get all the food from databse
                $sql="SELECT * FROM  tbl_food";
                 
                //execute the query
                $res=mysqli_query($conn, $sql);

                //count rows to check wheather we have food or not
                $count=mysqli_num_rows($res);
                
                $sn=1;
                if($count>0)
                {
                    //grt the value from individual column
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        $description=$row['description'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        ?>
                             <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $price;?></td>
                                
                                <td>
                                <?php 
                                    //check wheather image is available or not
                                    if($image_name!="")
                                    {
                                        //display the image
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" width="100" >
                                        <?php
                                    }
                                    else
                                    {
                                        //display the message
                                        echo "<div class='error'>Image not added.</div>";
                                    }
                                ?>
                                </td>
                                <td><?php echo $description;?></td>
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-Secondary">Update Food</a>
                                    <br>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                
                                </td>
                            </tr>


                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='7' class='error'>Food not added yet.</td></tr>";
                }
            ?>
           


        </table>
    </div>
</div>
<?php include('partials/footer.php')
?>