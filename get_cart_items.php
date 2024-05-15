<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cartt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'cart' session variable is set
if (isset($_SESSION['cart'])) {
    $cartItems = array();
    foreach ($_SESSION['cart'] as $productId) {
        // Query the database to get product details
        $sql = "SELECT id, name, price FROM product WHERE id = $productId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cartItems[] = $row;
            }
        }
    }

    // Return cart items as JSON response
    echo json_encode($cartItems);
} else {
    // If the 'cart' session variable is not set, return an empty array
    echo json_encode(array());
}

// Close the database connection
$conn->close();
?>
