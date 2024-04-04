<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>


        <!-- add category form starts here -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- add category form ends here -->

        <?php
        // check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "clicked";
            // 1. get the value from category form
            $title = $_POST['title'];
            // for radio button, check whether it is checked or not
            if (isset($_POST['featured'])) {
                // get the value from form
                $featured = $_POST['featured'];
            } else {
                // set the default value
                $featured = "No";
            }


            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = 'No';
            }

            // check whether the image is selected or not and set value for name accordingly
            // print_r($_FILES['image']);
            // die(); // break code here
            if (isset($_FILES['image']['name'])) {
                // upload the image
                // to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                // auto rename images
                // get extension of our images(.jpg,.png etc)eg "fpood.jpg

                $ext = end(explode('.', $image_name));

                // rename the image
                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; // eg: Food_Category_776.jpg


                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;

                // finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // check whether image is uploaded or not
                // if not uploaded we stop the process and redirect with error message
                if ($upload == FALSE) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div";
                    // redirect to add category page
                    header('location:' . SITEURL . 'admin/add-category.php');

                    // stop the process
                    die();
                }
            } else {
                // dont upload and set value as blanl
                $image_name = "";
            }


            // 2. create sql query to insert data into database
            $sql = "INSERT INTO tbl_category SET 
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            // 3. execute the query and save in database
            $res = mysqli_query($conn, $sql);

            // check whether query is executed or not
            if ($res == TRUE) {
                // query executed and category added
                $_SESSION['add'] = "<div class='success'>Category added</div>";
                // redirect to manage category page
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
                // redirect to manage category page
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>







<?php include('partials/footer.php'); ?>