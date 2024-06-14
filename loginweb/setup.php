<?php



//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google = new Google_Client();

//Set the OAuth 2.0 Client ID
$google->setClientId('600849393126-2v3mdgujrs7tcbf0ak3lqauaqk87aqrq.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google->setRedirectUri('http://localhost/foodaj/index.php');

// to get the email and profile 
$google->addScope('email');

$google->addScope('profile');

//start session on web page
session_start();
