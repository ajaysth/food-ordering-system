<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Enter current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter new password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Enter new password again">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">

                    </td>
                </tr>
            </table>



        </form>
    </div>
</div>





<?php

// check whethet submit button is clicked or not
if (isset($_POST['submit'])) {
    // echo "clicked";
    // get data from form 
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // check whether user with current id and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    // execute the query
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // user exists and password can be changed
            // echo "User found";

            // check whether new password and confirm password match
            if ($new_password == $confirm_password) {
                // update the password
                // create query to update password
                $sql2 = "UPDATE tbl_admin SET
                password='$new_password'
                WHERE id=$id;
                ";

                // executing the query
                $res2 = mysqli_query($conn, $sql2);
                //check whether query executed or not
                if ($res2 == TRUE) {
                    // display success message

                    //redirect to manage admin page with success message
                    $_SESSION['changed-pwd'] = "<div class='success'>Password Changed</div>";
                    // redirect 
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    // display error message

                    //redirect to manage admin page with error message
                    $_SESSION['changed-pwd'] = "<div class='error'>Password Not Changed/div>";
                    // redirect 
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                //redirect to manage admin page with error message
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Not Matched</div>";
                // redirect 
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            // user dont exists
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
            // redirect 
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }


    // check whether current or new password match or not
}

?>





<?php include('partials/footer.php') ?>