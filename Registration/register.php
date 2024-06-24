


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


  <?php
// Define variables and set to empty values
$fullnameErr = $usernameErr = $emailErr = $passwordErr = $phonenumberErr = $dateofbirthErr = $genderErr = $currentaddressErr = $cityErr = $provinceErr = "";
$fullname = $username = $email = $password = $phonenumber = $dateofbirth = $gender = $currentaddress = $alt_address = $city = $province = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Full Name validation
    if (empty($_POST["fname"])) {
        $fullnameErr = "Full Name is required";
    } else {
        $fullname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) {
            $fullnameErr = "Only letters and white space allowed";
        }
    }

    // Username validation
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        if (strlen($username) < 5) {
            $usernameErr = "Username must be at least 5 characters long";
        }
    }

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Password validation
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters long";
        }
    }

    // Phone Number validation
    if (empty($_POST["phone"])) {
        $phonenumberErr = "Phone Number is required";
    } else {
        $phonenumber = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phonenumber)) {
            $phonenumberErr = "Invalid phone number format";
        }
    }

    // Date of Birth validation
    if (empty($_POST["dob"])) {
        $dateofbirthErr = "Date of Birth is required";
    } else {
        $dateofbirth = test_input($_POST["dob"]);
    }

    // Gender validation
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Current Address validation
    if (empty($_POST["address"])) {
        $currentaddressErr = "Current Address is required";
    } else {
        $currentaddress = test_input($_POST["address"]);
    }

    // City validation
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
    } else {
        $city = test_input($_POST["city"]);
    }

    // Province validation
    if (empty($_POST["province"])) {
        $provinceErr = "Province is required";
    } else {
        $province = test_input($_POST["province"]);
    }

    // Alternate Address is optional, so no validation is applied
    $alt_address = test_input($_POST["alt_address"]);

    // If all validation checks pass, you can proceed with further processing (e.g., saving data to the database)
    if (empty($fullnameErr) && empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($phonenumberErr) && empty($dateofbirthErr) && empty($genderErr) && empty($currentaddressErr) && empty($cityErr) && empty($provinceErr)) {
        // Further processing (e.g., saving data to the database)
        

ob_start();

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
      ob_end_flush();
      $_SESSION['add'] = "<div class='success'>User added successfully</div>";
    }




  }


    }
}

// Function to sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

  
  


    <section class="container">
      

    <div class="head">
        <div class="upbar">
          <div class="logo">
            <img src="../logimg/logo.png" alt="Restaurant Logo" class="img-responsive" height="100px" >
          </div>
          <div class="login">
            <div class="loglink">
              <a href="../login/index.php" class="login">Login</a>
            </div>
          </div>
          
      </div>

    </div>
      <header>Registration Form</header>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="POST">
        <div class="input-box">
          <label>Full Name</label>
          <input type="text" name="fname" placeholder="Enter full name" required />
          <span style="color:red;"><?php echo $fullnameErr; ?></span>
        </div>

        <div class="input-box">
          <label>Username</label>
          <input type="text" name="username" placeholder="Enter username" required />
          <span style="color:red;"><?php echo $usernameErr; ?></span>
        </div>

        <div class="input-box">
          <label>Email </label>
          <input type="text" name="email" placeholder="Enter email address" required />
          <span style="color:red;"><?php echo $emailErr; ?></span>
        </div>

        <div class="input-box">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter Password" required />
          <span style="color:red;"><?php echo $passwordErr; ?>
        </div>

        <div class="column">
          <div class="input-box">
            <label>Phone Number</label>
            <input type="number" name="phone" placeholder="Enter phone number" required />
            <span style="color:red;"><?php echo $phonenumberErr; ?></span>
          </div>
          <div class="input-box">
            <label>Birth Date</label>
            <input type="date" name="dob" placeholder="Enter birth date" required />
            <span style="color:red;"><?php echo $dateofbirthErr; ?></span>
          </div>
        </div>
        <div class="gender-box">
          <h3>Gender</h3>
          <div class="gender-option">
            <div class="gender">
              <input type="radio" id="check-male" name="gender" value="male" checked />
              <label for="check-male">male</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="gender" value="female"/>
              <label for="check-female">Female</label>
            </div>
            <!-- <div class="gender">
              <input type="radio" id="check-other" name="gender" />
              <label for="check-other">prefer not to say</label>
            </div> -->
            <span style="color:red;"><?php echo $genderErr; ?></span>
          </div>
        </div>
        <div class="input-box address">
          <label>Address</label>
          <input type="text" name="address" placeholder="Enter  address" required />
          <span style="color:red;"><?php echo $currentaddressErr; ?>
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
            <span style="color:red;"><?php echo $cityErr; ?>
          </div>
          <div class="column">
            <input type="text" name="province" placeholder="Enter your Province" required />
            <span style="color:red;"><?php echo $provinceErr; ?>
            <!-- <input type="number" placeholder="Enter postal code" required /> -->
          </div>
        </div>
        <button name="submit">Submit</button>

        <!-- <p>Already have an account?</p><button >
          <div class="login"><a href="../login/index.php">Login</a></div></button> -->

        <!-- <div class="haveacc">
            <p>Already have an account?</p><button class="login"><a href="../login/index.php">Login</a></button>
          </div>
      </form> -->
    </section>
  </body>
</html>



