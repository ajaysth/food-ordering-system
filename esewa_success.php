<?php include('partials-front/menu.php'); 

if (isset($_GET['oid']) && isset($_GET['amt']) && isset($_GET['refId'])) {
    $order_id = $_GET['oid'];
    $amount = $_GET['amt'];
    $reference_id = $_GET['refId'];

    // Verify transaction
    $esewa_verify_url = "https://esewa.com.np/epay/transrec";
    $data = [
        'amt' => $amount,
        'rid' => $reference_id,
        'pid' => $order_id,
        'scd' => 'YOUR_ESEWA_MERCHANT_ID'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $esewa_verify_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if (strpos($response, "Success") !== false) {
        // Transaction successful, update order status in the database
        $sql = "UPDATE tbl_order SET status = 'Paid', transaction_id = ? WHERE ref_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $reference_id, $_SESSION['ref_id']);
        $stmt->execute();

        echo "Payment successful!";
    } else {
        echo "Payment verification failed.";
    }
} else {
    echo "Invalid request.";
}
?>
