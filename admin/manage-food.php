<?php include('partials/menu.php') ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>

        <!-- button to add admin -->
        <a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            // query to get all the food
            $sql = "SELECT * FROM tbl_food";
            // execute the query
            $res = mysqli_query($conn, $sql);

            // count wors to check whether we have foods or not
            $count = mysqli_num_rows($res);

            // create serial number variable and set default value to 1
            $sn = 1;


            if ($count > 0) {
                // we have food in database
                // get the food and display
                while ($row = mysqli_fetch_assoc($res)) {
                    // get the value from individual columns
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>


                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $price ?></td>
                        <td>
                            <?php
                            // check whether we have image or not
                            if ($image_name == "") {
                                // display error message
                                echo "<div class='error'>NO images added</div>";
                            } else {
                                // we have image and display image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?> " width='100px'>

                            <?php
                            }



                            ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="" class="btn-secondary">Update</a>
                            <a href="" class="btn-danger">Delete</a>

                        </td>
                    </tr>



            <?php
                }
            } else {
                // we dont have food in database
                echo "<tr><td colspan='7' class='error'>Food not added yet.</td></tr>";
            }


            ?>



        </table>
    </div>
</div>











<?php include('partials/footer.php') ?>