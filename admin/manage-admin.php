<?php include('partials/menu.php')
?>
    <!-- menu section end -->
    
    <!-- main section start -->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br/><br/>
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
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];//Displaying session massage
            unset($_SESSION['update']);//Removing session massage
        }
        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];//Displaying session massage
            unset($_SESSION['user-not-found']);//Removing session massage
        }
        if(isset($_SESSION['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match'];//Displaying session massage
            unset($_SESSION['pwd-not-match']);//Removing session massage
        }
        if(isset($_SESSION['change-pwd']))
        {
            echo $_SESSION['change-pwd'];//Displaying session massage
            unset($_SESSION['change-pwd']);//Removing session massage
        }
        ?>
        <!-- button for add admin -->
        <br/><br/><br/>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br/><br/><br/>


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                //Query to get all the admin
                $sql="SELECT * FROM tbl_admin";
                //Execute the query
                $res=mysqli_query($conn, $sql);

                $sn=1;//declare a variable for serial number in while loop
                //check wheather query is executed or not
                if($res==TRUE)
                {
                    //count rows to check wheather have data in database or not
                    $rows=mysqli_num_rows($res);//function to get all the row in database

                    //chek the number of row
                    if($rows>0)
                    {
                        //we have data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //using while loop to get all the data from database
                            //and while loop run as long as the data in database

                            //get individual data
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            //Display the value in out table
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username ?></td>
                                <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?> " class="btn-primary">Change password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?> " class="btn-Secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?> " class="btn-danger">Delete Admin</a>
                                
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else{

                    }
                }

            ?>

           

        </table>
          </div>
    </div>
    <!-- main section end -->

    <?php include('partials/footer.php')
?>