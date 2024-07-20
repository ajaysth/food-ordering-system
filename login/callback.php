<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('98777106871-eoib15ugeohas5ji388b1vhged4ho4g.apps.googleusercontent.com');
$client->setClientSecret('GOCSPX-nlI02hX3OPZ7wMLQsJwewX6GVw3');
$client->setRedirectUri('http://localhost/foodaj/index.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Get user profile information from Google
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;
    $address = $google_account_info->address;

    // Connect to the database
    $mysqli = new mysqli('localhost', 'root', '', 'food-order');

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check if user already exists
    $stmt = $mysqli->prepare("SELECT * FROM tbl_users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, update information if necessary
        $stmt = $mysqli->prepare("UPDATE users SET name = ?, address = ? WHERE email = ?");
        $stmt->bind_param('sss', $name, $address, $email);
        $stmt->execute();
    } else {
        // User does not exist, insert new record
        $stmt = $mysqli->prepare("INSERT INTO tbl_users (name, email, address) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $name, $email, $address);
        $stmt->execute();
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();

    // Set session variables or perform other login actions
    $_SESSION['user'] = $email;
    $_SESSION['user'] = $name;

    // Redirect to the desired page after login
    header('Location: http://localhost/foodaj/index.php');
    exit();
}
?>
