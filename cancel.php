<?php
include('partials-front/menu.php'); 

// Clear the cart session
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    

}
// Redirect to homepage or previous page
header("Location: food.php"); // Adjust the target location as needed
exit();


?>
