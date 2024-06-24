
<?php include('partials-front/menu.php'); 




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    $total=0;


    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $food_name = $item['title'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $order_date = date("Y-m-d h:i:sa"); // order date
            $total += $item['price'] * $item['quantity'];
            

            // Insert order into the database
            $sql = "INSERT INTO tbl_order SET
                food='$food_name',
                price=$price,
                qty=$quantity,
                order_date='$order_date',
                total=$total,
                customer_name='$customer_name',
                customer_contact='$contact',
                customer_email='$email',
                customer_address='$address'
            ";
            $stmt = mysqli_query($conn,$sql);
            // $stmt->bind_param( $food_name, $quantity,$total, $price,$order_date, $customer_name, $contact, $email,$address);

            if ($stmt== TRUE) {
                // Successfully inserted
                $_SESSION['add'] = "<div class='success'>Food ordered successfully</div>";
                header('location: success.php');
            } else {
                // Handle error
                echo "Error: " . $conn->error;
            }
        }

        // Clear the cart after successful insertion
        unset($_SESSION['cart']);
        header('Location: success.php'); // Redirect to a success page
        exit();
     } else {
        echo "Cart is empty.";
    }
} else {
    echo "Invalid request.";
}

 
?>


