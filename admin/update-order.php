<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            <!-- add Order form start -->

            <?php
                //check wheather id is set or not
                if(isset($_GET['id']))
                {
                    //get the id and all other detail
                    $id=$_GET['id'];
                    //create sql queyy to get all other deatil
                    $sql="SELECT * FROM tbl_order WHERE id=$id";

                    //execute the query
                    $res=mysqli_query($conn, $sql);

                    //count the row check wheather id is valid or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //get all data
                        $row=mysqli_fetch_assoc($res);
                        
                        $food=$row['food'];
                        $price=$row['price'];
                        $qty=$row['qty'];
                        $status=$row['status'];
                        $customer_name=$row['customer_name'];
                        $customer_contact=$row['customer_contact'];
                        $customer_email=$row['customer_email'];
                        $customer_address=$row['customer_address'];

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
                        <td>Food Name:</td>
                        <td><?php echo $food;?></td>
                    </tr>

                    <tr> 
                        <td>Price:</td>
                        <td><?php echo $price;?></td>
                    </tr>

                    <tr>
                        <td>Qty:</td>
                        <td>
                            <input type="number" name="qty" value="<?php echo $qty;?>" >
                        </td>
                    </tr>

                    <tr>
                        <td>Status:</td>
                        <td>
                            <select name="status" id="">
                                <option <?php if($status=="Ordered"){ echo "selected";}?> value="Ordered">Ordered</option>
                                <option <?php if($status=="On Delivery"){ echo "selected";}?>value="On Delivery">On Delivery</option>
                                <option <?php if($status=="Delivered"){ echo "selected";}?>value="Delivered">Delivered</option>
                                <option <?php if($status=="Cancalled"){ echo "selected";}?>value="Cancalled">Cancalled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer contact</td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer email:</td>
                        <td>
                            <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer address:</td>
                        <td>
                            <textarea name="customer_address" id="" cols="25" rows="5" ><?php echo $customer_address;?></textarea>
                        </td>
                    </tr>

                    <tr>
                    <td colspan="2">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary" >
                    </td>
                    </tr>
                </table>
            </form>
             <!-- add Order form end -->

             <?php
                if(isset($_POST['submit']))
                {
                    //get all value from our form
                    $id=$_POST['id'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price*$qty;
                    $status=$_POST['status'];
                    $customer_name=$_POST['customer_name'];
                    $customer_contact=$_POST['customer_contact'];
                    $customer_email=$_POST['customer_email'];
                    $customer_address=$_POST['customer_address'];
                    //updating image if selected

                    //update database
                    $sql3="UPDATE tbl_Order SET
                    qty=$qty,
                    total=$total,
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    WHERE id=$id
                    ";
                    //execute query
                    $res3=mysqli_query($conn, $sql3);

                    //redirect the Order with mesage
                    //checked wheather executed or not
                    if($res3==true)
                    {
                        $_SESSION['update']="<div class='success'>Updated successfully</div>";
                        //redirect to add Order page
                        header('location:'.SITEURL.'admin/manage-Order.php');
                    }
                    else
                    {
                        $_SESSION['update']="<div class='error'>Failed to update Order</div>";
                        //redirect to add Order page
                        header('location:'.SITEURL.'admin/manage-Order.php');
                    }
                }
             ?>
            
        </div>
    </div>

<?php include('partials/footer.php'); ?>