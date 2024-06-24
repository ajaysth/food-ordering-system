<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food-order";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$item = $_GET['item'];

$sql = "SELECT * FROM tbl_order WHERE food = '$item' AND status = 'ordered' LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // echo "<h3> SN: " . $row['id'] . "</h3>";
        echo "<h5> Food: " . $row['food'] . "</h5>";
        // echo "<p> Price: " . $row['price'] . "</p>";
        echo "<p> Quantity: " . $row['qty'] . "</p>";
        echo "<p> Status:" . $row['status'] . "</p>";
        echo "<p> Customer: " . $row['customer_name'] . "</p>";
        // echo "<p> Price:" . $row['price'] . "</p>";
        // Add more fields as needed
    }
} else {
    echo "<div>No details found</div>";
}
$conn->close();
?>
