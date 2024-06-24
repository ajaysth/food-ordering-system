<?php include('../config/constants.php');
include('login-check.php');
?>




<html>

<head>
    <title>Food Ordering System-Homepage</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- <style>
        .dark-mode {
    background-color: black;
    color: white;
  }
    </style> -->
    
</head>

<body>
    <!-- Menu section starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a class="fs-5" href="index.php">Home</a></li>
                <!-- <li><a class="fs-5" href="manage-admin.php">Admin Manager</a></li> -->
                <li><a class="fs-5" href="manage-user.php">User Manager</a></li>
                <li><a class="fs-5" href="manage-category.php">Category</a></li>
                <li><a class="fs-5" href="manage-food.php">Food</a></li>
                <li><a class="fs-5" href="manage-order.php">Order</a></li>

                <li><a class=" fs=4 btn btn-danger"  style=" position:absolute; right: 5px" href="logout.php" onclick="sure()"><i class="fa fa-sign-out" style="color: white; " aria-hidden="true"></i></a></li>
                
            </ul>

            


        </div>

    </div>
    <!-- Menu section ends -->