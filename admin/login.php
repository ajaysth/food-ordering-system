<?php include('../config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br>

        <!-- login form starts -->
        <form action="" method="POST" class="text-center">
            Username:<br>

            <input type="text" name="username" placeholder="Enter your username"><br><br>


            Password:<br>

            <input type="password" name="password" placeholder="Enter your password"><br><br>


            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>

        </form>

        <!-- login form ends here -->
    </div>
</body>

</html>

<?php

// check whether submit button clicked or not
if (isset($_POST['submit'])) {
    // process for login
    // 1. get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //  2. sql to check whether user with username or password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // 3. execute query
    $res = mysqli_query($conn, $sql);

    // 4. count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // user available and login success
        $_SESSION['login'] = "<div class='success'>Login successful</div>";
        $_SESSION['user'] = $username; // to check whether is logged in or not and logout will unset it
        // redirect to homepage dashboard
        header('location:' . SITEURL . 'admin/');
    } else {
        // user not available and login unsuccessful
        $_SESSION['login'] = "<div class='error text-center'>Username or password not matched</div>";
        // redirect to login page
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>