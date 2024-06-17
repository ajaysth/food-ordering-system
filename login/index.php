<?php require_once('setup.php') ?>
<?php include('config/constants.php') ?>







<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login  </title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Login</header>
                <br>

                <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; //displaying session messages
                unset($_SESSION['add']); //removing session messages
            }
    
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

            if (isset($_SESSION['empty'])) {
                echo $_SESSION['empty'];
                unset($_SESSION['empty']);
            }
            
    
    ?>
    <br>

                
                <form action="" method="post">
                    <div class="field input-field">
                        <input type="username" name="username" placeholder="Username" class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" name="password" placeholder="Password" class="password">
                        <!-- <i class='bx bx-hide eye-icon'></i> -->
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field button-field">
                        <button name="submit">Login</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Don't have an account? <a href="../Registration/register.php" class="link signup-link">Signup</a></span>
                </div>
            </div>

            <div class="line"></div>

            <div class="media-options">
                <a href="#" class="field facebook">
                    <i class='bx bxl-facebook facebook-icon'></i>
                    <span>Login with Facebook</span>
                </a>
            </div>

            <div class="media-options">
                <a href="<?php echo $google->createAuthUrl(); ?>" class="field google">
                    <img src="images/google.png" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>

        </div>

        
        </div>
    </section>

    <!-- JavaScript -->
    <!-- <script src="js/script.js"></script> -->

    <!-- <script>
        pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        
        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })
        
    })
})  
    </script> -->
</body>

</html>



<?php
// session_start();
//  include('config/constants.php'); 

// check whether submit button clicked or not
if (isset($_POST['submit'])) {
    // process for login
    // 1. get the data from login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    //  2. sql to check whether user with username or password exist or not
    $sql = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password'";

    // 3. execute query
    $res = mysqli_query($conn, $sql);

    // 4. count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // user available and login success
        $_SESSION['login'] = "<div class='success'>Login successful</div>";
        $_SESSION['user'] = $username; // to check whether is logged in or not and logout will unset it
        // redirect to homepage dashboard
        
        header('location:'.SITEURL.'index.php');
    } else {
        // user not available and login unsuccessful
        $_SESSION['login'] = "<div class='error text-center'>Please enter valid username and password.</div>";
        // redirect to login page
        header('location:' .SITEURL.'login/index.php');
    }
}

// if (isset($_POST['submit'])) {
//     if($username=="" OR $password==""){
//         $_SESSION['empty'] = "<div class='error text-center'>Enter username or password</div>";
//         // redirect to login page
//         header('location:' .SITEURL.'login/index.php');

//     }

?>