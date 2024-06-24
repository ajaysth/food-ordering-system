<?php
// include constant file
include('../config/constants.php');
// echo "delete page";
// check whether the value id and image name is passed or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    // get the value and delete
    // echo "get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // remove the physical image if available
    if ($image_name != "") {
        // image available
        $path = "../images/category/" . $image_name;
        // remove the file
        $remove = unlink($path);

        // if failed to remove the image display error message and stop the process
        if ($remove == FALSE) {
            // set the session message
            $_SESSION['remove'] = "<div class='error text-center'>Failed to remove category image</div>";
            // redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-category.php');

            // stop the process
            die();
        }
    }


    // delete data from database
    // query to delete data from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    // execution of query
    $res = mysqli_query($conn, $sql);

    // check whether query is executed or not
    if ($res == TRUE) {
        // set success message and redirect
        $_SESSION['delete'] = "<div class='success text-center'>Category deleted successfully</div>";
        // redirect to manage admin page
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        // set fail message and redirect
        $_SESSION['delete'] = "<div class='error text-center'>Failed to delete category</div>";
        // redirect to manage admin page
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    // redirect to manage category page
    header('location:' . SITEURL . 'admin/manage-category.php');
}
