<?php include('partials/menu.php') ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>

        <br><br>


        <!-- button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>

        <!-- <div class="container mt-5">
        <div class="form-group position-relative">
            <input type="text" class="form-control" placeholder="Search..." onkeyup="showRecommendations(this.value)">
            <div id="recommendations"></div>
        </div>
        <div id="item-details" class="mt-3"></div>
    </div> -->

    <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> -->

        <table class="table table-striped" style="border-collapse: collapse;">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            // query to get all category from database
            $sql = "SELECT * FROM tbl_category";

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
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title ?></td>
                        <td>
                            <?php
                            // check whether image is available or not
                            if ($image_name != "") {
                                // display image
                            ?>
                                <img class="rounded mx-auto d-block" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                            <?php

                            } else {
                                // display message
                                echo "<div class='error'>No images added</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn btn-outline-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-outline-danger">Delete</a>

                        </td>
                    </tr>


                <?php
                }
            } else {
                // we dont have data in database
                // we will display the message in table
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Category added</div>
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