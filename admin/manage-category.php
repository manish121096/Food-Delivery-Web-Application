<?php include('partials/menu.php')
?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Displaying session massage
                unset($_SESSION['add']);//Removing session massage
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];//Displaying session massage
                unset($_SESSION['remove']);//Removing session massage
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];//Displaying session massage
                unset($_SESSION['delete']);//Removing session massage
            }
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];//Displaying session massage
                unset($_SESSION['no-category-found']);//Removing session massage
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];//Displaying session massage
                unset($_SESSION['update']);//Removing session massage
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];//Displaying session massage
                unset($_SESSION['upload']);//Removing session massage
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];//Displaying session massage
                unset($_SESSION['failed-remove']);//Removing session massage
            }
        ?>
        <br><br>
        <!-- button for add Category -->
        <br/><br/><br/>
        <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title:</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

                //query to get all category to database
                $sql="SELECT * FROM tbl_category";

                //execute query
                $res=mysqli_query($conn, $sql);

                $count=mysqli_num_rows($res);

                $sn=1;//create a variable for serial number and assign 1
                //check wheather we have data in database or not
                if($count>0)
                {
                    //we have data in database
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        
                        ?>
                         <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php 
                                    //check wheather image is available or not
                                    if($image_name!="")
                                    {
                                        //display the image
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width="100" >
                                        <?php
                                    }
                                    else
                                    {
                                        //display the message
                                        echo "<div class='error'>Image not added.</div>";
                                    }
                                ?>
                             </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-Secondary">Update Category</a>
                                
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                            
                            </td>
                        </tr>
                        <?php
                    }

                }
                else
                {
                    //we do not have the data display the message
                    ?>
                    <tr>
                        <td colspan='6'><div class="error">No category added</div></td>
                    </tr>

                    <?php
                }
            ?>
           

        </table>
    </div>
</div>
<?php include('partials/footer.php')
?>