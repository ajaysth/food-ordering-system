<?php include('partials-front/menu.php'); 
ob_start();
$total='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_method = $_POST['payment_method'];

    // Calculate the total price
    $total_price = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total = $item['price'] * $item['quantity'];
        }
    } else {
        echo "Cart is empty.";
        exit();
    }

    // Store total price in session for later use
    $_SESSION['total_price'] = $total;

    if ($payment_method == 'Cash on Delivery')
     {
        
        $_SESSION['add'] = "<div class='success text-center'>Ordered placed succesfully.</div>";
            header('Location:'.SITEURL. 'food.php');
            unset($_SESSION['cart']);
            ob_end_flush();
            exit();
    } elseif ($payment_method == 'eSewa') {
        // eSewa redirect
        header('Location: esewa_payment.php');
        exit();
    } else {
        echo "Invalid payment meth0od.";
    }
} else {
    echo "Invalid request.";
}
?>
