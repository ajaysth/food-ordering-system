<?php include('partials/menu.php') ?>



<div class="main-content">
    <div class="wrapper" style="width:96%">
        <h1 class="fs-1 text-center">Manage Order</h1>
        <br><br><br>

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>


<div class="search-container">
        <form action="javascript:void(0);" method="get">
            <input type="text" placeholder="Search.." onkeyup="showRecommendations(this.value)" name="query">
            <button type="submit">Search</button>
        </form>
        <div id="recommendations"></div>
        <div id="item-details"></div>

        </div>



        <!-- button to add admin
        <a href="" class="btn-primary">Add Order</a> -->
        <br>
        <br>

        <table class="table table-striped">
            <tr >
                <th >S.N</th>
                <th >Food</th>
                <th >Price</th>
                <th >Qty</th>
                <th >Total</th>
                <th >order Date</th>
                <th >Status</th>
                <th >Customer Name</th>
                <th >Contact</th>
                <th >Email</th>
                <th >Address</th>
                <th >Actions</th>
            </tr>

            <?php
            // get all the details from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // display latest order at first
            // execute query
            $res = mysqli_query($conn, $sql);
            //  count the rows
            $count = mysqli_num_rows($res);

            $sn = 1; // create a serial number ans set initial value as 1

            if ($count > 0) {
                // order available
                while ($row = mysqli_fetch_assoc($res)) {
                    // get all the order details
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
            ?>

                    <tr>
                        <td style="padding-left:3px;"><?php echo $sn++; ?></td>
                        <td style="padding-left:3px;"><?php echo $food; ?></td>
                        <td style="padding-left:3px;"><?php echo $price; ?></td>
                        <td style="padding-left:3px;"><?php echo $qty; ?></td>
                        <td style="padding-left:3px;"><?php echo $total; ?></td>
                        <td style="padding-left:3px;"><?php echo $order_date; ?></td>
                        <!-- <td>
                            <?php
                            // ordered, On delivery, Delivered, Canceled
                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "On Delivery") {
                                echo "<label style='color: orange;'>$status</label>";
                            } elseif ($status == "Delivered") {
                                echo "<label style='green: orange;'>$status</label>";
                            } elseif ($status == "Canceled") {
                                echo "<label style='color: red;'>$status</label>";
                            }
                            ?>
                        </td> -->

                        <td style="padding-left:3px;"><?php echo $status; ?></td>
                        <td style="padding-left:3px;"><?php echo $customer_name; ?></td>
                        <td style="padding-left:3px;"><?php echo $customer_contact; ?></td>
                        <td style="padding-left:3px;"><?php echo $customer_email; ?></td>
                        <td style="padding-left:3px;"><?php echo $customer_address; ?></td>
                        <td style="padding-left:3px;">
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn btn-outline-secondary">Update</a>
                            <a href="" class="btn btn-outline-danger">Delete</a>

                        </td>
                    </tr>


            <?php
                }
            } else {
                // order not available
                echo "<tr><td colspan='12' class='error text-center'>Orders not available</td></tr>";
            }


            ?>



        </table>
    </div>
</div>

<!-- <script>
        function showRecommendations(str) {
            if (str.length == 0) {
                document.getElementById("recommendations").innerHTML = "";
                return;
            }
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("recommendations").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "recommend.php?q=" + str, true);
            xmlhttp.send();
        }
    </script> -->

<script>
    function showRecommendations(str) {
            if (str.length == 0) {
                document.getElementById("recommendations").innerHTML = "";
                return;
            }
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("recommendations").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "recommend.php?q=" + str, true);
            xmlhttp.send();
        }

        function showItemDetails(item) {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("item-details").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "item-details.php?item=" + item, true);
            xmlhttp.send();
        }
    </script>



<?php include('partials/footer.php') ?>