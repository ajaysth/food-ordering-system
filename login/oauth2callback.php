<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('987877106871-eoib15ugeouha5sj3188b1vhggd4ho49.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/foodaj/login/index.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Get user profile information from Google
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;

    // Here you could authenticate the user in your system or create a new account

    // Redirect to the desired page after login
    header('Location: http://localhost/foodaj/index.php');
    exit();
}
