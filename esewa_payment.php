<?php include('partials-front/menu.php'); 

$total_price = $_SESSION['total_price'];
$esewa_merchant_id = 'EPAYTEST';
$esewa_return_url = 'localhost/foodaj/esewa_success.php';
$esewa_cancel_url = 'localhost/foodaj/esewa_cancel.php';

// eSewa Payment URL
$esewa_payment_url = "https://rc-epay.esewa.com.np/api/epay/main/v2/form";

// Generate unique reference ID for the transaction
$ref_id = uniqid();
$_SESSION['ref_id'] = $ref_id;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to eSewa</title>
</head>
<body onload="document.forms['esewaForm'].submit();">
    <form name="esewaForm" action="<?php echo $esewa_payment_url; ?>" method="POST">
        <input type="hidden" name="amt" value="<?php echo $total_price; ?>">
        <input type="hidden" name="pdc" value="0">
        <input type="hidden" name="psc" value="0">
        <input type="hidden" name="txAmt" value="0">
        <input type="hidden" name="tAmt" value="<?php echo $total_price; ?>">
        <input type="hidden" name="pid" value="<?php echo $ref_id; ?>">
        <input type="hidden" name="scd" value="<?php echo $esewa_merchant_id; ?>">
        <input type="hidden" name="su" value="<?php echo $esewa_return_url; ?>">
        <input type="hidden" name="fu" value="<?php echo $esewa_cancel_url; ?>">
    </form>
</body>
</html>
