<?php include('partials-front/menu.php'); 

// $sql= "SELECT * FROM tbl_users WHERE username = $user";
// $result= mysqli_query($conn, $sql);

$sql = "SELECT * FROM tbl_users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user);
$stmt->execute();
$result = $stmt->get_result();

// Step 5: Display user information
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "User ID: " . $row["id"]. "<br>";
    echo "Name: " . $row["fname"]. "<br>";
    echo "Email: " . $row["email"]. "<br>";
    // Add more fields as needed
} else {
    echo "No user found with  $user";
}

    

