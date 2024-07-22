<?php
require_once 'vendor/autoload.php';
require_once '../partials-front/menu.php';
session_start();




// $client = new Google_Client();
// $client->setClientId('98777106871-eoib15ugeohas5ji388b1vhged4ho4g.apps.googleusercontent.com');
// $client->setClientSecret('GOCSPX-nlI02hX3OPZ7wMLQsJwewX6GVw3');
// $client->setRedirectUri('http://localhost/foodaj/login/oauth2callback.php');

$google = new Google_Client();

//Set the OAuth 2.0 Client ID
$google->setClientId('987877106871-eoib15ugeouha5sj3188b1vhggd4ho49.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google->setRedirectUri('http://localhost/foodaj/login/oauth2callback.php');
// $google->setRedirectUri('http://localhost/foodaj/index.php');


// to get the email and profile 
$google->addScope('email');

$google->addScope('profile');


if (isset($_GET['code'])) {
    $token = $google->fetchAccessTokenWithAuthCode($_GET['code']);

    // Debugging: Output the $token array
    echo '<pre>';
    print_r($token);
    echo '</pre>';

    // Check for errors in the token response
    if (isset($token['error'])) {
        die("Error fetching access token: " . $token['error_description']);
    }

    if (isset($token['access_token'])) {
        $google->setAccessToken($token['access_token']);

        // Get user profile information from Google
        $google_oauth = new Google_Service_Oauth2($google);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;
        $address = $google_account_info->address;
        $password = $google_account_info->password;

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
            $stmt = $mysqli->prepare("UPDATE tbl_users SET fname = ? WHERE email = ?");
            $stmt->bind_param('ss', $name, $email);
            $stmt->execute();
        } else {
            // User does not exist, insert new record
            $stmt = $mysqli->prepare("INSERT INTO tbl_users (fname, email) VALUES (?, ?)");
            $stmt->bind_param('ss', $name, $email);
            $stmt->execute();
        }

        // Close the statement and connection
        // $stmt->close();
        // $mysqli->close();

        // Set session variables or perform other login actions
        
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;

        // Redirect to the desired page after login
        header('Location: ../index.php');
        exit();
    } else {
        die("Access token not found in the response.");
    }
} else {
    die("Authorization code not found.");
}
?>
