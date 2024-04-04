<?php include('partials/menu.php') ?>


<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>
    <br>
    <br>

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add']; //displaying session messages
      unset($_SESSION['add']); //removing session messages
    }
    ?>

    <form action="" method="POST">

      <table class="tbl-30">
        <tr>
          <td>Full Name</td>
          <td><input type="text" name="full_name" placeholder="Enter your fullname"></td>
        </tr>

        <tr>
          <td>Username</td>
          <td><input type="text" name="username" placeholder="Enter your username"></td>
        </tr>

        <tr>
          <td>Password</td>
          <td><input type="password" name="password" placeholder="Enter your password"></td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>



<?php include('partials/footer.php') ?>


<?php
// process the value from form and save in database
// check whether the button is clicked or not

if (isset($_POST['submit'])) {
  // get the data

  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']); //password encryption with md5

  //sql query to save in database
  $sql = "INSERT INTO tbl_admin SET 
     full_name='$full_name',
     username='$username',
     password='$password'
     ";


  //executing query and saving into database
  $res = mysqli_query($conn, $sql) or die(mysqli_error());

  //check whether the (query is executed or not)data inserted or not and display proper message
  if ($res == TRUE) {
    //Data inserted
    // echo "data inserted";
    //create a session variable to display message
    $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
    //Redirect page to manage admin page
    header("location:" . SITEURL . 'admin/manage-admin.php');
  } else {
    //not 
    // echo "not inserted";
    //create a session variable to display message
    $_SESSION['add'] = "Failed to add admin";
    //Redirect page to add admin page
    header("location:" . SITEURL . 'admin/add-admin.php');
  }
}





?>