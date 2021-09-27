
<?php include('partials/menu.php');?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylecont.css">  
      
</head>

<body>
    <section class="contact">
        <!-- header section start -->
        <div class="content">
            <h2>Contact Us</h2>
            <p>Here You Can Connect With Us</p>
        </div>
        <!-- header section end -->

        <div class="container2" >
            <!-- Addrerss section start -->
                <div class="contactInfo">
                    <div class="box">
                        <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3>Address</h3>
                                <p>STATION ROAD,Hajipur(BIHAR)</p>
                        </div>    
                    </div>
                    <div class="box">
                        <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3><strong>Phone No-</strong></h3>
                            <p>MOB:-9162550676</p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3><strong>Email-</strong></h3>
                            <p>desidhaba@gmail.com</p>
                        </div>
                    </div>
                </div>
            <!-- Address section end here -->

            <!-- Form section start here -->
                <div class="contactForm">
                    <form>
                        <h2>Send Message</h2><br>
                        <div class="inputBox">
                            <input type="text" name="" required="required">
                            <span>Full Name</span>
                        </div>
                        <div class="inputBox">
                                <input typr="text" name="" required="required">
                                <span>Email</span>
                        </div>
                        <div class ="inputBox">
                            <textarea required="required" ></textarea>
                        <span> Type your Message Here...</span> 
                        </div>
                        <div class="inputBox">  
                            <input type="Submit" name="" value="Send">
                        </div>    
                    </form>  
                </div> 
        </div>
    </section>
</body>

<?php include('partials/footer.php');?>


