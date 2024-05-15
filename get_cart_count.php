<?php


// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the count of items in the cart
$sql = "SELECT COUNT(*) AS count FROM addtocart";
$result = $conn->query($sql);

if ($result === false) {
    // Query failed, output the error
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Fetch the count
    $row = $result->fetch_assoc();
    $count = $row['count'];
    echo $count; // Output the count
} else {
 
}

$conn->close();
?>
