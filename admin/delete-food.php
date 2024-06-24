<?php
// include constants page
include('../config/constants.php');

// echo "delete food";

if (isset($_GET['id']) and isset($_GET['image_name'])) {
    // process to delete
    // echo "process to delete";

    // 1. get id and image name 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];


    // 2. remove the image if available
    // check whether image is available or not and delete if available
    if ($image_name != "") {
        // it has image and need to delete from folder
        // get the image path
        $path = "../images/food/" . $image_name;

        // remove image from folder
        $remove = unlink($path);

        // check whether the image is removed or not
        if ($remove == FALSE) {
            // failed to delete image
            $_SESSION['upload'] = "<div class='error text-center'>Failed t0 remove image.</div>";
            // redirect to manage food
            header('location:' . SITEURL . 'admin/manage-food.php');
            // stop the process
            die();
        }
    }

    // 3. delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether query is executed or not and set session message
    if ($res == TRUE) {
        // food deleted
        $_SESSION['delete'] = "<div class='success text-center'>Food deleted successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        // failed to delete food
        $_SESSION['delete'] = "<div class='error text-center'>Failed to delete food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // redirect to manage food page
    // echo "redirect";
    $_SESSION['unauthorize'] = "<div class='error text-center'>Unauthorized Access</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
