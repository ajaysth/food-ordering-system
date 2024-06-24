<?php
error_reporting(0);
require_once('setup.php');
if (isset($_GET['code'])) {
    //token
    $token = $google->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['token'] = $token;
    if (!isset($token["error"])) {
        $google->setAccessToken($token['access_token']);
        $service = new Google_Service_Oauth2($google);

        $data = $service->userinfo->get();

        // print_r($data);



        // echo "Firstname:" . $data['givenName'];
        // echo "<br>Lastname:" . $data['familyName'];
        // echo "Email:" . $data['email'];
        // echo "<br><img src='" . $data['picture'] . "'>";

        $_SESSION['name'] = $data['name'];
        $_SESSION['src'] = $data['picture'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['address'] = $data['address'];
        $_SESSION['gender'] = $data['gender'];
    }
}


require 'db_connection.php'; // Make sure you have a file to handle the database connection


    // Assuming you have fetched user's name and email from Google and stored in session
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password

    // Insert user into the database
    $sql = "INSERT INTO tbl_users SET

    fname='$name',
    
    email='$email',
    password='$password',
    
    ";



  //executing query and saving into database
  $res = $conn->query($sql);



  if ($res == TRUE) {
      
      // $_SESSION['add'] = "<div class='success'>User added successfully</div>";
      //Redirect page to manage admin page
      header("location:".'../index.php');
      ob_end_flush();
      $_SESSION['add'] = "<div class='success'>Logged in</div>";
    }

?>
