<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('987877106871-eoib15ugeouha5sj3188b1vhggd4ho49.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/foodaj/login/oauth2callback.php');
$client->addScope("email");
$client->addScope("profile");

// $client->addScope("https://www.googleapis.com/auth/drive");
// $client->addScope("https://www.googleapis.com/auth/calendar");
// $client->addScope("https://www.googleapis.com/auth/gmail.readonly");
// $client->addScope("https://www.googleapis.com/auth/contacts.readonly");
// $client->addScope("https://www.googleapis.com/auth/youtube.readonly");

// Generate a URL to request access from Google's OAuth 2.0 server:
$auth_url = $client->createAuthUrl();

echo json_encode(['url' => $auth_url]);
