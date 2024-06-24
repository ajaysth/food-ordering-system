<?php include('partials/menu.php') ?>



<div class="main-content">
    <div class="wrapper"></div>
    <h1 class="fs-1 text-center">Manage User</h1>
        <br><br>

            <?php

                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }


            ?>
<br>
<br>
        <table class="table table-striped" style="border-collapse: collapse; padding:3%">
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>  
                    <th>Actions</th>
                </tr>

                <?php
                // query to get all category from database
                $sql = "SELECT * FROM tbl_users";

                // execute query
                $res = mysqli_query($conn, $sql);

                // count rows
                $count = mysqli_num_rows($res);

                // create a serial number variable and assign value as 1
                $sn = 1;


                // check whether we have data in database or not
                if ($count > 0) {
                    // we have data in database
                    // get the data and display
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $fname = $row['fname'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $address = $row['address'];
                        

                ?>

                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $fname ?></td>
                            <td><?php echo $username ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $phone ?></td>
                            <td><?php echo $address ?></td>
                            <td>
                                <!-- <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn btn-outline-secondary">Update</a> -->
                                <a href="<?php echo SITEURL; ?>admin/delete-user.php?id=<?php echo $id; ?>" class="btn btn-outline-danger">Delete</a>

                            </td>
                        </tr>


                    <?php
                    }
                } else {
                    // we dont have data in database
                    // we will display the message in table
                    ?>
                    <tr>
                        <td colspan="7">
                            <div class="error">No User added</div>
                        </td>
                    </tr>
                <?php

                }
                ?>


            </table>
    </div>
</div>



<!-- <script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script> -->


<?php include('partials/footer.php') ?>