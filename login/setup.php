<?php



//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google = new Google_Client();

//Set the OAuth 2.0 Client ID
$google->setClientId('987877106871-eoib15ugeouha5sj3188b1vhggd4ho49.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google->setRedirectUri('http://localhost/foodaj/login/oauth2callback.php');

// to get the email and profile 
$google->addScope('email');

$google->addScope('profile');

//start session on web page
session_start();




// Check if the user is authenticated
// if (isset($_GET['code'])) {
//     $token = $google->fetchAccessTokenWithAuthCode($_GET['code']);
//     if (!isset($token['error'])) {
//         $google->setAccessToken($token['access_token']);

//         // Get profile info
//         $google_service = new Google_Service_Oauth2($google);
//         $data = $google_service->userinfo->get();

//         $_SESSION['user'] = $data;
//         $_SESSION['login_message'] = "Login successful";

//         header('Location: http://localhost/foodaj/index.php');
//         exit();
//     } else {
//         echo "Error during authentication: " . $token['error'];
//     }
// }

