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

$q = $_GET['q'];

$sql = "SELECT food FROM tbl_order WHERE food LIKE '%$q%' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div onclick=\"showItemDetails('" . $row['food'] . "')\">" . $row['food'] . "</div>";
    }
} else {
    echo "<div>No suggestions</div>";
}
$conn->close();
?>
