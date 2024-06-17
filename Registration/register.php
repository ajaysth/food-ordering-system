


<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="register.css" />
  </head>
  <body>
    <section class="container">

    <div class="head">

    </div>
      <header>Registration Form</header>
      <form action="" class="form" method="POST">
        <div class="input-box">
          <label>Full Name</label>
          <input type="text" name="fname" placeholder="Enter full name" required />
        </div>

        <div class="input-box">
          <label>Username</label>
          <input type="text" name="username" placeholder="Enter username" required />
        </div>

        <div class="input-box">
          <label>Email </label>
          <input type="text" name="email" placeholder="Enter email address" required />
        </div>

        <div class="input-box">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter Password" required />
        </div>

        <div class="column">
          <div class="input-box">
            <label>Phone Number</label>
            <input type="number" name="phone" placeholder="Enter phone number" required />
          </div>
          <div class="input-box">
            <label>Birth Date</label>
            <input type="date" name="dob" placeholder="Enter birth date" required />
          </div>
        </div>
        <div class="gender-box">
          <h3>Gender</h3>
          <div class="gender-option">
            <div class="gender">
              <input type="radio" id="check-male" name="gender" checked />
              <label for="check-male">male</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="gender" />
              <label for="check-female">Female</label>
            </div>
            <!-- <div class="gender">
              <input type="radio" id="check-other" name="gender" />
              <label for="check-other">prefer not to say</label>
            </div> -->
          </div>
        </div>
        <div class="input-box address">
          <label>Address</label>
          <input type="text" name="address" placeholder="Enter  address" required />
          <input type="text" name="alt_address" placeholder="Enter alternate address" required />
          <div class="column">
            <!-- <div class="select-box">
              <select>
                <option hidden>Country</option>
                <option>America</option>
                <option>Japan</option>
                <option>India</option>
                <option>Nepal</option>
              </select>
            </div> -->
            <input type="text" name="city" placeholder="Enter your city" required />
          </div>
          <div class="column">
            <input type="text" name="province" placeholder="Enter your Province" required />
            <!-- <input type="number" placeholder="Enter postal code" required /> -->
          </div>
        </div>
        <button name="submit">Submit</button>
      </form>
    </section>
  </body>
</html>



<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="food-order";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);




// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";



// process the value from form and save in database
// check whether the button is clicked or not

if (isset($_POST['submit'])) {
  // get the data

  $fname = $_POST['fname'];
  $username = $_POST['username'];
  $password = $_POST['password']; 
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $alt_address = $_POST['alt_address'];
  $city = $_POST['city'];
  $province = $_POST['province'];

  

  //sql query to save in database
  $sql = "INSERT INTO tbl_users SET

    fname='$fname',
    username='$username',
    email='$email',
    password='$password',
    phone=$phone,
    dob='$dob',
    gender='$gender',
    address='$address',
    alt_address='$alt_address',
    city='$city',
    province='$province'
    ";



  //executing query and saving into database
  $res = $conn->query($sql);

  //check whether the (query is executed or not)data inserted or not and display proper message
  // if ($res == TRUE) {
  //   //Data inserted
  //   // echo "data inserted";
  //   //create a session variable to display message
  //   $_SESSION['add'] = "<div class='success'>User added successfully</div>";
  //   //Redirect page to manage admin page
  //   header("location:".'login/index.php');
  // } else {
  //   //not 
  //   // echo "not inserted";
  //   //create a session variable to display message
  //   $_SESSION['add'] = "Failed to add user";
  //   //Redirect page to add admin page
  //   // header("location:" . SITEURL . 'login/index.php');
  //   header("location:".'login/index.php');
  // }

  if ($res == TRUE) {
      
      // $_SESSION['add'] = "<div class='success'>User added successfully</div>";
      //Redirect page to manage admin page
      header("location:".'../login/index.php');
      $_SESSION['add'] = "<div class='success'>User added successfully</div>";
    }




  }

?>