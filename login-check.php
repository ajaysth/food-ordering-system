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
