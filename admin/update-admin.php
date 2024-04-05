<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>

        <?php
        // get the id of selected admin
        $id = $_GET['id'];

        //create the query 
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check whether query is executed or not
        if ($res == TRUE) {
            // check whether data is available or not
            $count = mysqli_num_rows($res);
            // check whether we have admin data or not
            if ($count == 1) {
                // get the data
                // echo "Admin available";
                $rows = mysqli_fetch_assoc($res);

                $full_name = $rows['full_name'];
                $username = $rows['username'];
            } else {
                // redirect to manage admin page
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }

        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>



        </form>
    </div>
</div>

<?php
// check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // echo "button clicked";
    // get all the values from the form to update
    echo $id = $_POST['id'];
    echo $full_name = $_POST['full_name'];
    echo $username = $_POST['username'];

    //create a query to update data
    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
    ";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the query is executed or not
    if ($res == TRUE) {
        // query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin Updated</div>";

        //redirect to admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        // not executed
        $_SESSION['update'] = "<div class='error'>Failed to update Admin</div>";

        //redirect to admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}

?>





<?php include('partials/footer.php'); ?>