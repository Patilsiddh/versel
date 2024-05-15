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

// Check if product name is set and not empty
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_name']) && !empty($_POST['product_name'])) {
    // Sanitize input to prevent SQL injection
    $productName = $conn->real_escape_string($_POST['product_name']);

    // Delete the product from the database
    $sql = "DELETE FROM AddtoCart WHERE name = '$productName'";
    if ($conn->query($sql) === TRUE) {
        // Product deleted successfully
        echo "Product deleted successfully";
    } else {
        // Error deleting product
        echo "Error: " . $conn->error;
    }
} else {
    // If product name is not set or empty
    echo "Invalid product name";
}

$conn->close();
?>
