<?php

//include constants.php file here
include('../config/constants.php');
//   1.get the id of the admin to be deleted

$id = $_GET['id'];


// 2. create the query to delete the admin

$sql = "DELETE FROM tbl_users WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check whether sql query executed or not
// 3. redirect to manage admin page with success/error message
if ($res == TRUE) {
    //deleted successfully
    // echo "Admin deleted";
    // create session variable to display message i
    $_SESSION['delete'] = "<div class='success text-center'>User deleted</div>";
    // redirect to manage admin page
    header('location:' . SITEURL . 'admin/manage-user.php');
} else {
    //not deleted
    // echo "not deleted";
    $_SESSION['delete'] = "<div class='error text-center'>Failed to delete admin</div>";
    header('location:' . SITEURL . 'admin/manage-user.php');
}
