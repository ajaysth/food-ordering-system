<?php


// destroy the session
session_destroy(); //unset $_SESSION('user')

// redirect to login page
header('location:' . SITEURL . 'login/index.php');