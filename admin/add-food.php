<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-striped">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter title of food">
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select image</td>
                    <td>
                        <input class="form-control" type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php
                            // to display categories from database
                            // 1.create sql query to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //execute query 
                            $res = mysqli_query($conn, $sql);
                            // count rows to check whether categories are available or not
                            $count = mysqli_num_rows($res);
                            // if count >0 we have categories else we dont 
                            if ($count > 0) {
                                // we have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    // get the detail of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php

                                }
                            } else {
                                // we dont have categories
                                ?>
                                <option value="0">No Categories found</option>
                            <?php
                            }
                            // 2. display on drop down



                            ?>


                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn btn-outline-success">
                    </td>
                </tr>


            </table>
        </form>


        <?php
        // check whether add food button is clicked or not
        if (isset($_POST['submit'])) {
            // add food in database
            // echo "added foods";
            // 1. get the data from form 
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            // check whether the featured and active value are checked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; // setting default value
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; // setting default value
            }
            // 2. upload the image if selected
            // check whether select image is clicked or not and upload the image only if selected
            if (isset($_FILES['image']['name'])) {
                // get details of the selected image
                $image_name = $_FILES['image']['name'];
                // check whether image is selectrd or not and upload if selected
                if ($image_name != "") {
                    // image is selected
                    // a. rename the image
                    // get the extension of selected image eg(.jpg,.png)
                    $ext = end(explode('.', $image_name));
                    // create new name for the image
                    $image_name = "Food-Name-" . rand(000, 999) . "." . $ext; // new image eg Food-Name-33.jpg

                    // b. upload image
                    // get the source path and destinmation path of the image
                    // source path is current l.ocation of the image
                    $src = $_FILES['image']['tmp_name'];

                    // destination path for the image to be uploaded
                    $dst = "../images/food/" . $image_name;

                    // finally upload the image
                    $upload = move_uploaded_file($src, $dst);

                    // check whether image is uploaded or not
                    if ($upload == FALSE) {
                        // failed to upload image
                        // redirect to manage food page with message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        // stop the process


                    }
                }
            } else {
                $image_name = ""; //setting default value ad blank
            }


            // 3. insert data in to database
            // query to insert data in database
            $sql2 = "INSERT INTO tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            ";
            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // check whether query is executed or not
            if ($res == TRUE) {
                // redirect to manage food page with success message
                $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                // error message
                $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }


            // 4. redirect to manage food page with message
        }


        ?>




    </div>
</div>








<?php include('partials/footer.php'); ?>