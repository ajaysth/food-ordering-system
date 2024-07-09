<?php include('partials-front/menu.php'); 
$total='';
   
    if (isset($_SESSION['transaction_msg'])) {
        echo $_SESSION['transaction_msg'];
        unset($_SESSION['transaction_msg']);
    }

    if (isset($_SESSION['validate_msg'])) {
        echo $_SESSION['validate_msg'];
        unset($_SESSION['validate_msg']);
    }
    ?>
  
    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
       foreach ($_SESSION['cart'] as $item) {
           $food_name = $item['title'];
           $quantity = $item['quantity'];
           $price = $item['price'];
           $order_date = date("Y-m-d h:i:sa"); // order date
        //    $string_value = $item['quantity'];
        //    $float_value = $item['price'];
        //    $converted_value = floatval($string_value);
           

        // $total += $item['price'] * $item['quantity'];
        $total=$total;
           
       }}
           
           ?>
    <h1 class="text-center">Khalti Payment </h1>
    <div class="d-flex justify-content-center mt-3">
        <form class="row g-3 w-50 mt-4" action="payreq.php" method="POST">
            <label for="">Product Details:</label>
            <div class="col-md-6">
                <label for="inputAmount4" class="form-label">Amount</label>
                <input type="Amount" class="form-control" id="inputAmount4" name="inputAmount4" value="<?php echo $total;?>">
            </div>
            <!-- <div class="col-md-6">
                <label for="inputPurchasedOrderId4" class="form-label">Purchased Order Id</label>
                <input type="PurchasedOrderId" class="form-control" id="inputPurchasedOrderId4" name="inputPurchasedOrderId4">
            </div>
            <div class="col-12">
                <label for="inputPurchasedOrderName" class="form-label">Purchased Order Name</label>
                <input type="text" class="form-control" id="inputPurchasedOrderName" name="inputPurchasedOrderName">
            </div> -->
            <label for="">Customer Details:</label>
            <div class="col-12">
                <label for="inputName" class="form-label">Please confirm your Name</label>
                <input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $food_name;?>">
            </div>
            <!-- <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="text" class="form-control" id="inputEmail" name="inputEmail">
            </div> -->
            <!-- <div class="col-md-6">
                <label for="inputPhone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="inputPhone" name="inputPhone">
            </div> -->
            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">Pay with khalti</button>
            </div>
        </form>
    </div>
    <br><br>


<?php include('partials-front/footer.php'); 