<?php include('partials-front/menu.php'); ?>
<div class="container">
    <h1 class="my-4">Choose Payment Method</h1>
    <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ob_start();
?>
<?php
 if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $food_name = $item['title'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $order_date = date("Y-m-d h:i:sa"); // order date
        $total += $item['price'] * $item['quantity'];
    }}
        
        ?>
    
    <form method="post" action="ok.php">
    <!-- <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="Cash on Delivery" required>
            <label class="form-check-label" for="cod">
                Cash on Delivery
            </label>
        </div> -->
        <!-- <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="esewa" value="eSewa" required>
            <label class="form-check-label" for="esewa">
                Pay with eSewa
            </label>
        </div> -->
        
            

 
        <button type="submit" name="cod" class="btn btn-primary mt-3">Cash on delivery</button>
    </form>
    <br><br>


    <?php
    $total_amount=100;
    $transaction_uuid=11-201-13;
    $product_code='EPAYTEST';
    $s = hash_hmac('sha256', 'Message', 'secret', true);
    base64_encode($s); 
    ?>

    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
            <input type="hidden" id="amount" name="amount" value="100" required>
            <input type="hidden" id="tax_amount" name="tax_amount" value ="10" required>
            <input type="hidden" id="total_amount" name="total_amount" value="110" required>
            <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="ab14a8f2b02c3"required>
            <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
            <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
            <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
            <input type="hidden" id="success_url" name="success_url" value="https://esewa.com.np" required>
            <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
            <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
            <input type="hidden" id="signature" name="signature" value="<?php echo base64_encode($s);?>" required>
            <input class="btn btn-success" value="Pay With eSewa" type="submit">
            </form><br><br>


            <button class="btn btn-warning" id="payment-button">Pay with Khalti</button>
</div>

<!-- <button class="btn btn-warning" id="payment-button">Pay with Khalti</button> -->




<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/enc-base64.min.js"></script>
<script>
 var hash = CryptoJS.HmacSHA256("Message", "secret");
 var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
 document.write(hashInBase64);
</script> -->


<script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_feb919f31eba40e0b2e99aad56ee91a3",
            "productIdentity": "1234567890",
            "productName": "Pizza",
            "productUrl": "http://localhost/foodaj/food.php",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                    <?php
                    unset($_SESSION['cart']);
                    ?>
                    
                    window.location.href = 'index.php';
                    alert('Payment Successful');
                },
                onError (error) {
                    console.log(error);
                    window.location.href = 'index.php';
                    
                    
                },
                onClose () {
                    // console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 19500});
        }
    </script>
    <!-- Paste this code anywhere in you body tag -->

<?php include('partials-front/footer.php'); ?>


