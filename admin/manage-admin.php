<?php include('partials/menu.php') ?>



<!-- main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session messages
            unset($_SESSION['add']); //removing session messages
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if (isset($_SESSION['changed-pwd'])) {
            echo $_SESSION['changed-pwd'];
            unset($_SESSION['changed-pwd']);
        }
        ?>
        <br>
        <br>

        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>

        <table class="table table-striped" style="border-collapse: collapse;">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //query to get all admin
            $sql = "SELECT * FROM tbl_admin";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //check whether the query is executed or not
            if ($res == TRUE) {
                //COUNT rows to check whether there are data in database
                $count = mysqli_num_rows($res);

                $sn = 1; //create a variable and assign the value

                //check number of rows
                if ($count > 0) {
                    //we have data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loop to get all the data in database
                        //it will run as long as we have data in database

                        //get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //display values in table

            ?>

                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn btn-outline-success">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn btn-outline-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn btn-outline-danger">Delete</a>

                            </td>
                        </tr>

            <?php
                    }
                }
            }

            ?>


        </table>




    </div>

</div>
<!-- main content section ends -->



<?php include('partials/footer.php') ?>