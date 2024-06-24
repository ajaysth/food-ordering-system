<?php
// authorization - access control
// to check whether the user is logged in or not
if (!isset($_SESSION['user'])) // is the user is not set
{
    // user not logged in
    // redirect to login page with message
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to Enter!! </div>";
    // redirect to login page
    header('location:' . SITEURL . 'login/index.php');
}

$user = $_SESSION['user'];
// echo $user;

// $sql = "SELECT * FROM tbl_users WHERE username = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $user);
// $stmt->execute();
// $result = $stmt->get_result();

