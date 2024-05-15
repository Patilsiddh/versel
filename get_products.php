<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch categories from the database
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);

$categories = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $category = array(
            'id' => $row['id'],
            'name' => $row['name']
        );
        $categories[] = $category;
    }
}

// Fetch products from database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($products);
?>
