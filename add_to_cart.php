<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";
$database = "ecommerce"; // Replace with your MySQL database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add product to cart
// Function to add product to cart
function addToCart($conn, $productId) {
    // Check if product with given ID exists in products table
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Product found, fetch product details
        $row = $result->fetch_assoc();
        // Insert product into addtocart table
        $productName = $row['name'];
        $productPrice = $row['price'];
        $productDescription = $row['description'];
        $productImage = $row['image_url'];
        $productCategory = $row['category'];
        $insertSql = "INSERT INTO addtocart (name, price, description, image_url, category) 
                      VALUES ('$productName', '$productPrice', '$productDescription', '$productImage', '$productCategory')";
        if ($conn->query($insertSql) === TRUE) {
            return true; // Success
        } else {
            return false; // Failed to insert product
        }
    } else {
        return false; // Product not found
    }
}

// Check if product ID is provided in the request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $success = addToCart($conn, $productId);
    $cartCount = count($_SESSION['cart']);
    header('Content-Type: application/json');
    echo json_encode(['success' => $success, 'cartCount' => $cartCount]);
}

$conn->close();
?>
