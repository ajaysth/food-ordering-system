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
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin Manager</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>

                <li><a href="logout.php" onclick="sure()">Logout</a></li>
                <button onclick="myFunction()">Toggle dark mode</button>
            </ul>


        </div>

    </div>
    <!-- Menu section ends -->