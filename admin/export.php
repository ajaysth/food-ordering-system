<?php include('partials/menu.php') ?>

<br><br>
<h1 class="text-center">Export the Data</h1>
        <br><br>


<div class="export" style="display:flex; align-items:center; justify-content:center;">

        <form class="text-center" method="get" action="generate_pdf.php">
                <label for="table">Select Table:</label>
                <select  name="table" id="table">
                    <option value="tbl_order">Orders</option>
                    <option value="tbl_food">Foods</option>
                    <option value="tbl_users">Users</option>
                </select>
                <button class="btn btn-success" type="submit">Export as PDF</button>
        </form><br><br><br><br>

        <form class="text-center" style="margin-left:20px" method="get" action="generate_excel.php">
                <label for="table">Select Table:</label>
                <select name="table" id="table">
                    <option value="tbl_order">Orders</option>
                    <option value="tbl_food">Foods</option>
                    <option value="tbl_users">Users</option>
                </select>
                <button class="btn btn-success" type="submit">Export as Excel</button>
        </form>
 
    
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>



    <?php include('partials/footer.php') ?>
