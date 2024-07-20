<?php include('partials/menu.php') ?>





<!-- main content section starts -->
<div class="main-content">
    <div class="wrapper  ">
        <h1>Dashboard</h1>
        <br><br>


        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

        <!-- <div class="col-4 text-center">
            <?php
            // query
            $sql = "SELECT * FROM tbl_category";
            //execute query
            $res = mysqli_query($conn, $sql);
            // count rows
            $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div> -->

        <div class="d-flex justify-content-between" style="margin-left:10px;">

            <div class="col-md-3">
                <div class="dashboard-box">
                <?php
            // query
            $sql = "SELECT * FROM tbl_category";
            //execute query
            $res = mysqli_query($conn, $sql);
            // count rows
            $count = mysqli_num_rows($res);
            ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    <h4>Categories</h4>
                </div>
        </div>

        <div class="col-md-3">
                <div class="dashboard-box">
                <?php
            // query
            $sql = "SELECT * FROM tbl_food";
            //execute query
            $res = mysqli_query($conn, $sql);
            // count rows
            $count = mysqli_num_rows($res);
            ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    <h4>Foods</h4>
                </div>
        </div>


        <div class="col-md-3">
                <div class="dashboard-box">
                <?php
            // query
            $sql = "SELECT * FROM tbl_order";
            //execute query
            $res = mysqli_query($conn, $sql);
            // count rows
            $count = mysqli_num_rows($res);
            ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    <h4>Orders</h4>
                </div>
        </div>

        <!-- <div class="col-md-3">
                <div class="dashboard-box">
                <?php
            // query
            $sql = "SELECT * FROM tbl_users";
            //execute query
            $res = mysqli_query($conn, $sql);
            // count rows
            $count = mysqli_num_rows($res);
            ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    <h4>Users</h4>
                </div>
        </div> -->


        <div class="col-md-3">
                <div class="dashboard-box">
                <?php
            // query to get total revenue
            // aggregate function
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
            // execute query
            $res4 = mysqli_query($conn, $sql4);

            // count the value
            $row4 = mysqli_fetch_assoc($res4);

            // get the total revenue
            $total_revenue = $row4['Total'];



            ?>
                    <h1><?php echo $total_revenue; ?></h1>
                    <br>
                    <h4>Revenue Generated</h4>
                </div>
        </div>

        </div>

        

        <!-- <div class="col-4 text-center">

            <?php
            // query
            $sql2 = "SELECT * FROM tbl_food";
            //execute query
            $res2 = mysqli_query($conn, $sql2);
            // count rows
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
        </div> -->



        <!-- <div class="col-4 text-center">

            <?php
            // query
            $sql3 = "SELECT * FROM tbl_order";
            //execute query
            $res3 = mysqli_query($conn, $sql3);
            // count rows
            $count3 = mysqli_num_rows($res3);
            ?>

            <h1><?php echo $count3; ?></h1>
            <br>
            Orders
        </div> -->

        <!-- <div class="col-4 text-center dashboard-box">
            <?php
            // query to get total revenue
            // aggregate function
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
            // execute query
            $res4 = mysqli_query($conn, $sql4);

            // count the value
            $row4 = mysqli_fetch_assoc($res4);

            // get the total revenue
            $total_revenue = $row4['Total'];



            ?>


            <h1><?php echo $total_revenue; ?></h1>
            <br>
            Revenue Generated
        </div> -->


        
        <div class="clearfix"></div>
        <br>
        <br><br>


        <a class="fs-5 btn btn-warning text-center" style="position:relative; left:45%"  href="export.php">Export data</a>
        <br>


    </div>
    <br>
    <br>
    <br>
    <br>

</div>
<!-- main content section ends -->




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 

<?php include('partials/footer.php') ?>