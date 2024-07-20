<?php 
include('config/constants.php');
include('login-check.php');


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/aboutus.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

    <script>
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to log out?")) {
                event.preventDefault();
            }
        }
    </script>

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navibar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right fs-3">
                <ul>
                    <li>
                        <a class="text-uppercase fs-5" style="text-decoration: none; font-family: 'Comic Sans MS', cursive, sans-serif;" href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a class="text-uppercase fs-5" style="text-decoration: none; font-family: 'Comic Sans MS', cursive, sans-serif;" href="<?php echo SITEURL; ?>category.php">Categories</a>
                    </li>
                    <li>
                        <a class="text-uppercase fs-5" style="text-decoration: none; font-family: 'Comic Sans MS', cursive, sans-serif;" href="<?php echo SITEURL; ?>food.php">Foods</a>
                    </li>
                    <li>
                        <a class="text-uppercase fs-5" style="text-decoration: none; font-family: 'Comic Sans MS', cursive, sans-serif;" href="<?php echo SITEURL; ?>aboutus.php">About US</a>
                    </li>
                    <li>
                        <a class="text-uppercase fs-5 btn btn-danger" style="text-decoration: none; font-family: 'Comic Sans MS', cursive, sans-serif;" href="login/logout.php" onclick="confirmLogout(event)"> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        
                    </li>
                    <!-- <li>
                        <a class="text-uppercase" style="text-decoration: none;" href="#" >My Cart(0)</a>
                        <i class="bi bi-bag-fill"></i>
                    </li> -->

                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->