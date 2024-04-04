<?php

//include constants.php file here
include('../config/constants.php');
//   1.get the id of the admin to be deleted

$id = $_GET['id'];


// 2. create the query to delete the admin

$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check whether sql query executed or not
if ($res == TRUE) {
    //deleted successfully
    // echo "Admin deleted";
    // create session variable to display message i
    $_SESSION['delete'] = "<div class='success'>Admin deleted</div>";
    // redirect to manage admin page
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    //not deleted
    // echo "not deleted";
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
}



// 3. redirect to manage admin page with success/error message
