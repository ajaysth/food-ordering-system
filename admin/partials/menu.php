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

    <script>
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to log out?")) {
                event.preventDefault();
            }
        }
    </script>


    <!-- <style>
        .dark-mode {
    background-color: black;
    color: white;
  }
    </style> -->

    <style>
        .dashboard-box {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            margin-bottom: 20px;
            flex:1;
        }
        .dashboard-box h3 {
            margin: 0;
            font-size: 2.5rem;
        }
        .dashboard-box p {
            margin: 0;
            color: #6c757d;
        }
        .export-btn {
            margin-top: 20px;
        }
    </style>
    
</head>

<body>
    <!-- Menu section starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a class="fs-5" href="index.php">Home</a></li>
                <!-- <li><a class="fs-5" href="manage-admin.php">Admin Manager</a></li> -->
                <li><a class="fs-5" href="usermanage.php">User Manager</a></li>
                <li><a class="fs-5" href="manage-category.php">Category</a></li>
                <li><a class="fs-5" href="manage-food.php">Food</a></li>
                <li><a class="fs-5" href="manage-order.php">Order</a></li>

                <li><a class=" fs=4 btn btn-danger"  style=" position:absolute; right: 5px" href="logout.php" onclick="confirmLogout(event)"><i class="fa fa-sign-out" style="color: white; " aria-hidden="true"></i></a></li>
                
            </ul>

            


        </div>

    </div>
    <!-- Menu section ends -->