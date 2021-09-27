<?php include('partials/menu.php')
?>
<!-- menu section end -->
    
    <!-- main section start -->
<div class="main-content">
    <div class="wrapper">
       <br>
        <h1>Dashboard</h1>
        <br><br>
        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];//Displaying session massage
                unset($_SESSION['login']);//Removing session massage
            }
        ?>
        <br><br>
            <div class="col-4 text-center">
            <?php
                //Query 
                $sql="SELECT * FROM tbl_category";
                //Execute the query
                $res=mysqli_query($conn, $sql);
                //get the count row
                $count=mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                <br/>
                Categaries
            </div>
            <div class="col-4 text-center">
            <?php
                //Query 
                $sql2="SELECT * FROM tbl_food";
                //Execute the query
                $res2=mysqli_query($conn, $sql2);
                //get the count row
                $count2=mysqli_num_rows($res2);
                ?>
               <h1><?php echo $count2; ?></h1>
                <br/>
                Foods
            </div>
            <div class="col-4 text-center">
            <?php
                //Query 
                $sql3="SELECT * FROM tbl_order";
                //Execute the query
                $res3=mysqli_query($conn, $sql3);
                //get the count row
                $count3=mysqli_num_rows($res3);
                ?>
               <h1><?php echo $count3; ?></h1>
                <br/>
                Total Order
            </div>
            <div class="col-4 text-center">
            <?php
                //create sql query to generate revenue
                //aggregrate functon to sql query
                $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                //Execute the query
                $res4=mysqli_query($conn, $sql4);
                //get the value
                $row=mysqli_fetch_assoc($res4);
               //get the total revenue
               $total_revenue=$row['Total'];
                ?>
               <h1>Rs. <?php echo $total_revenue; ?></h1>
                <br/>
                Revenue Generated
            </div>
        
        <div class="clearfix"></div>
    </div>
</div>
    <!-- main section end -->
<?php include('partials/footer.php')
?>