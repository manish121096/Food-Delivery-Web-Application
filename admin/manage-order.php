<?php include('partials/menu.php')
?>
<div class="main-content">
    <div class="wrapper">
        <br>
    <h1>Manage Order</h1>
        <br><br>  

        <?php
                 if(isset($_SESSION['update']))
                 {
                     echo $_SESSION['update'];//Displaying session massage
                     unset($_SESSION['update']);//Removing session massage
                 }
                 ?>
                 <br>
                 <br>
        <table class="tbl-full">
            <tr>
                <th>S.No.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Cust_Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                //get all the order from database
                $sql="SELECT * FROM tbl_order ORDER BY id DESC";
                //Execute query
                $res=mysqli_query($conn, $sql);
                //count the rows
                $count=mysqli_num_rows($res);
                $sn=1;
                if($count>0)
                {
                    //order avialable
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get all the order detail
                        $id=$row['id'];
                        $food=$row['food'];
                        $price=$row['price'];
                        $qty=$row['qty'];
                        $total=$row['total'];
                        $order_date=$row['order_date'];
                        $status=$row['status'];
                        $customer_name=$row['customer_name'];
                        $customer_contact=$row['customer_contact'];
                        $customer_email=$row['customer_email'];
                        $customer_address=$row['customer_address'];

                        ?>
                              <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $food;?></td>
                                        <td><?php echo $price;?></td>
                                        <td><?php echo $qty;?></td>
                                        <td><?php echo $total;?></td>
                                        <td><?php echo $order_date;?></td>
                                        <td>
                                            <?php
                                                //changed color on delivery, on delivery, delivered and cancel
                                                if($status=="Ordered")
                                                {
                                                    echo "<lable>$status</lable>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<lable style='color:orange;'>$status</lable>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<lable style='color:green;'>$status</lable>";
                                                }
                                                elseif($status=="Cancalled")
                                                {
                                                    echo "<lable style='color:red;'>$status</lable>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $customer_name;?></td>
                                        <td><?php echo $customer_contact;?></td>
                                        <td><?php echo $customer_email;?></td>
                                        <td><?php echo $customer_address;?></td>
                                        
                                        <td>
                                    <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-Secondary">Update Order</a>
                                </td>
                            </tr>
                        <?php

                    }
                }
                else
                {
                    //order not available
                    echo "<div class='error'>Order not available.</div>";
                }
            ?>
          

        </table>
    </div>
</div>
<?php include('partials/footer.php')
?>