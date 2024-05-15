<?php
// add_product.php

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";
$database = "ecommerce"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (isset($_POST["product-name"]) && isset($_POST["product-price"]) && isset($_POST["product-description"]) && isset($_POST["product-image"])) {
        // Get form data
        $productName = $_POST["product-name"];
        $productPrice = $_POST["product-price"];
        $productDescription = $_POST["product-description"];
        $productImage = $_POST["product-image"];

        // SQL query to insert product into database
        $sql = "INSERT INTO products (name, price, description, image_url)
                VALUES ('$productName', '$productPrice', '$productDescription', '$productImage')";

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {
            echo "New product added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: All form fields are required";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin-styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .admin-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        .admin-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .admin-container form {
            display: flex;
            flex-direction: column;
        }

        .admin-container label {
            margin-bottom: 8px;
        }

        .admin-container input,
        .admin-container textarea {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .admin-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .admin-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <h1>Add New Product</h1>
        <form action="add_product.php" method="POST">
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="product-name" required><br>

            <label for="product-price">Price:</label>
            <input type="text" id="product-price" name="product-price" required><br>

            <label for="product-description">Description:</label><br>
            <textarea id="product-description" name="product-description" rows="4" cols="50" required></textarea><br>

            <label for="product-image">Image URL:</label>
            <input type="text" id="product-image" name="product-image" required><br>

            <!-- Move the Add Product button inside the form -->
            <button type="submit">Add Product</button>
        </form>
    </div>
</body>

</html>
