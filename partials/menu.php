
<?php include('config/constants.php'); ?>

<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>India Ka Dhaba | DesiDhaba.com</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="logo/logo2.jpg" alt="Restaurant Logo" class="img-responsive">
                    <h1>KHAO, PIYO,<br> AISH KARO</h1>
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li class="item"><a href="<?php echo SITEURL; ?>service.php">Service</a></li>
                    <li class="item"><a href="<?php echo SITEURL; ?>contact.php">Contact Us</a></li>
                    <li class="item"><a href="<?php echo SITEURL; ?>about.php">About Us</a></li>
                    <li class="item"><a href="<?php echo SITEURL; ?>map.php">Find Us</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->