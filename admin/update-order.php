<?php include('partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>


        <?php
        ob_start();
        // check whether id is set or not
        if (isset($_GET['id'])) {
            // get order details
            $id = $_GET['id'];
            // get all other details based on this id
            // query to details of order
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            // execute the query
            $res = mysqli_query($conn, $sql);

            // count rows
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // details available
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];;
                $customer_address = $row['customer_address'];
            } else {
                // details not available
                // redirect ti manage order page
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        } else {
            // redirect to manage order page
            header('location:' . SITEURL . 'admin/manage-order.php');
        }
        ?>

        <form action="" method="POST">
            <table class="table table-striped">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>Rs.<?php echo $price; ?></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input class="form-control" type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select class="form-select" name="status">
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    } ?> value=")rdered">Ordered</option>
                            <option <?php if ($status == "On delivery") {
                                        echo "selected";
                                    } ?> value="On delivery">On Delivery</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == "Canceled") {
                                        echo "selected";
                                    } ?> value="Canceled">Canceled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea class="form-control" name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn btn-outline-success">
                    </td>
                </tr>

            </table>
        </form>


        <?php

        
        // check whether update button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "clicked";
            // get all the values from form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;
            $status = $_POST['status'];

            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];


            // update the values
            // query 
            $sql2 = "UPDATE tbl_order SET 
                qty=$qty,
                total=$total,
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'

                WHERE id=$id
            ";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);
            // checl whether updated or not
            if ($res2 == TRUE) {
                // updated
                $_SESSION['update'] = "<div class='success'>Order updated successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
                ob_end_flush();
            } else {
                // failed
                $_SESSION['update'] = "<div class='error'>Failed to update order.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            }

            // redirecy to manage order with message
        }

        ?>




    </div>
</div>












<?php include('partials/footer.php'); ?>