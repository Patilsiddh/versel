
<?php
// add_product.php

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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (isset($_POST["product-name"]) && isset($_POST["product-price"]) && isset($_POST["product-description"]) && isset($_POST["product-image"]) && isset($_POST["product-category"])) {
        // Get form data
        $productName = $_POST["product-name"];
        $productPrice = $_POST["product-price"];
        $productDescription = $_POST["product-description"];
        $productImage = $_POST["product-image"];
        $productCategory = $_POST["product-category"];

        // SQL query to insert product into database
        $sql = "INSERT INTO products (name, price, description, image_url, category)
                VALUES ('$productName', '$productPrice', '$productDescription', '$productImage', '$productCategory')";

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {
            // Redirect back to the main page after adding the product
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {

    }
}



// Check if the product ID is provided in the request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $success = addToCart($productId);
    $cartCount = count($_SESSION['cart']);
    header('Content-Type: application/json');
    echo json_encode(['success' => $success, 'cartCount' => $cartCount]);
}

$products = [];

// Your code to fetch products and assign them to the $products array

// Check if $products is not null and not empty before using foreach loop
if (!empty($products)) {
    foreach ($products as $product) {
        // Your code to iterate through products
    }
} else {
    // Handle case when $products is empty or null
    
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Products</title>
    <link rel="stylesheet" href="admin-styles.css">
    <style>
       

     

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

  body,html {
    font-family: "Amazon Ember", Arial, sans-serif;
    font-size: 70.5%;
  }
  ul{
    list-style: none;
  }

  .links{
    cursor: pointer;
  }

  h2{
    font-size: 2.4rem;
    text-align:center;
  }

  
#logo>img{
height:50px; 
width: 100px;

}

.navbar {


height: 100%;
background-color: #070e34;
color:white;
display: flex;

justify-content: space-evenly;
align-items: center;
}


.border{
border: 1.5 px solid transparent;
}

.border:hover {
border: 1.5px solid white;
}

.add-first{
color: #cccccc;
font-size:  1.5rem;
margin-left: 15px;
}

.add-second{

font-size: 1.5rem;
margin-left: 3px;
}

.add-icon { 

display: flex;
align-items: center;
font-size: large;
}

.nav-search{
display: flex;
justify-content: space-evenly;
 width:900px ;
height: 40px;
border-radius: 4px;
}

.search-select{
background-color: #F3F3F3;
width: 50px;
text-align: center;
border-top-left-radius: 4px;
border-bottom-left-radius: 4px;
border:none;
}

.search-input{
    width : 100%;
 font-size: 1.5rem;
 border: none;
}



.Search-icon{
width: 45px;
background-color:#febd68;
font-size:1.8rem;
border-top-right-radius: 4px;
border-bottom-right-radius: 4px;
display : flex;
justify-content: center;
align-items: center;
color: #0f1111;
}

.nav-search:hover{
border: 2px solid orange;
}
.nav-second{
font-size: 1rem;

}


span{
font-size: 1.5rem;

}



.nav-cart  {
font-size: 2rem;

}


.panel{
 height: 40px;
background-color: #222f3d;
display: flex;
color:white;
align-items: center;
justify-content: space-between;
}
.panel-all ,  .panel-deals{
font-size: 1.5rem;
}
.panel-ops{
width: 70%;
font-size: 15px;
height: 40px;
background-color: #222f3d;
display: flex;
color:white;
align-items: center;
justify-content: space-between;
}


.ads-image-container .ads-image-top{
      height: 45;
      width: 650;
      max-width: 100%;
      border: 0;
      display: block;
      margin-left: auto;
      margin-right: auto;
      height: 45px;
      aspect-ratio: auto 650 / 45;
      width: 650px;
      overflow-clip-margin: content-box;
      overflow: clip;
  } 

  .category-list {
      width: 150rem;
      display: flex;
      margin: 0 auto;
      font-size: 1.2rem;
      line-height: 12px;
      margin-top: .8rem;
      padding-left: 1.8rem;
      color: var(--links-color-dark);
      gap :.5rem;
  }

  /* Navbar Ends */

  

        /* Add padding for content */
        /* Navbar Ends */
        .product-container {
      

    flex-wrap: wrap; /* Ensure products stay in a single row */
    overflow-x: auto; /* Enable horizontal scrolling if necessary */
    background-color: #f7e18a;
    justify-content: space-evenly; /* Start from the left of the container */
    align-items: center; /* Center items vertically */
}

.category-section {
    display: block; /* Add display flex to allow product cards to be in a row */
    flex-direction: column; /* Arrange product cards vertically within each category section */
    align-items: center; /* Center product cards horizontally */
}



        .hero-section {
            background-image: url("https://images-eu.ssl-images-amazon.com/images/G/31/img24/1499/hero/MED_Under1499_Hero_PC_1500x600._CB558773342_.jpg");
            height: 380px;

            background-size: cover;
            display: flex;
            justify-content: center;

            align-items: flex-end;
        }

        .hero-msg {

            background-color: white;
            color: black;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            width: 80%;
            margin-bottom: 25px;
        }

        .hero-msg a {
            color: #007185
        }

  


        /*Footer Starts*/
        .foot-panel1 {
            background-color: #37475a;
            color: white;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;

        }

        .foot-panel2 {
            background-color: #222f3d;
            color: white;
            height: 300px;
            display: flex;
            justify-content: space-evenly;
        }

        ul {
            margin-top: 20px;
            padding: 10px;
        }

        ul p {
            font-weight: 100px;
            font-size: 1.2rem;
        }

        ul a {

            display: block;
            font-size: .85rem;
            color: #dddddd;
            margin: 8px;
        }

        .foot-panal3 {
            color: white;
            background-color: #222f3d;
            border-top: .5px solid white;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .foot-panel4 {
            background-color: #0f1111;
            color: white;
            text-align: center;
            height: 75px;
            font-size: 0.7rem;
        }

        .pages {


            padding-top: 25px;
        }

        .copyright {
            padding-top: 5px;
        }

        /*Footer Ends*/

        /* CSS for Category Sections */

  



.products-container {
    display: flex;
    flex-wrap: wrap;
 
    background-color: white; /* Background color */

  

}

.product {


    background-color: white; /* Background color */
    margin: 40px 0  20px  80px;
    border: 5px solid gray; /* Border color and thickness */
    margin: 50px; /* Margin to create a gap between product boxes */
padding-left: 15px;
padding-right: 15px;



}



.product>p{
    font-size: 15px;
  }


a{
    text-decoration: none;
    color: white;
}


    </style>
</head>

<body>

  <!-- Top Part NavBar -->
   

  <div class="navbar">
        <div id="logo"> 
            <img src="https://tse3.mm.bing.net/th?id=OIP.jrf82BrfUlBS15n-X3tTLgHaE9&pid=Api&P=0&h=220" alt="amazon_logo.png">
             
         </div>
           
            <div class="Location">
                
                        

                <p class="add-first">Deliver to</p>
                <div class="add-icon">
                    <i class="fa-solid fa-location-dot"></i>            
                    <p class="add-second">Pune</p>
                </div>
            </div>
           
            <div class="nav-search">
           
                <select class="search-select">
                     <option>All</option>
                     <option>Cloths</option>
                     <option>Laptops</option>
                     <option>Phones</option>
                     <option>Television</option>
                     <option>Health </option>
                     <option>Fashion Deals</option>
                    </select>

                <input placeholder="Search amazon" class="search-input" >
                <div class="Search-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
         

            <div class="lang ">
         
                <select class="lang-select">
                    <option >English</option>
                    <option>Germany</option>
                    <option>French</option>
                    <option>Hindi </option>
                    <option>Marathi</option>
                </select>
                  </div>

         

            <div class="nav-signin border">
                <p><span>Hello, sign in</span></p>
                <p class="nav-second">Account & Lists</p>
           
            </div>
            <div class="nav-return border">
                <p><span>Returns</span></p>
                <p class="nav-second">& Orders</p>

            </div>
          
            <div class="nav-cart border"> 
                <i class="fa-solid fa-cart-shopping"></i>
              
    <div class="nav-cart border">
          
            <a href="Addtocart.php">Cart (<span id="cart-count">0</span>)</a>
        </div>

            </div>

        </div>
   

    <div class="panel">
        <div class="panel-all">
            <i class="fa-solid fa-bars"></i>
            ALL
        </div>
        <div class="panel-ops">
      

            <p>Today's Deals</p>
            <p>Hot Deals</p>
            <p>Customer Service</p>
            <p>Gift Cards </p>
            <p>Mini Tv</p>
            <p>Coupans</p>
            <p>Amazon Pay</p>
            <p>Amazon Prime</p>
            <p>Amazon Basics</p>
            <p>Sell</p>
            <p>Buy again</p>
            <p>Browse Everything</p>
        </div>
        <div class="panel-deals"> Shop Deals in Electronics</div>
    </div>
     </div>
      <!-- NavBar Ends -->








       



    
    <!-- Hero section -->
    <div class="hero-section">
        <div class="hero-msg">
            <p>You are on amazon.com. You can also shop on Amazon India <a> click here to go to amazon.in</a></p>
        </div>
    </div>
   

    <!-- HTML Structure -->


   
    <!-- Add more sections for additional categories as needed -->
</div>










    <div class="product-container" id="product-container">
   
        <!-- Product cards will be dynamically generated here -->
        <?php
       
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
        
        // Function to fetch and display products for a specific category
        function displayProducts($conn, $category) {
            $sql = "SELECT * FROM products WHERE category='$category'";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                echo "<div class='product-row'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-card'>";
                    // Display product details
                    echo "<img src='" . $row["image_url"] . "' alt='Product Image'>";
                    echo "<div class='product-details'>";
                    echo "<div class='product-name'>" . $row["name"] . "</div>";
                    echo "<div class='product-price'>$" . $row["price"] . "</div>";
                    echo "<div class='product-description'>" . $row["description"] . "</div>";
                    echo "<button class='add-to-cart-button'>Add to Cart</button>";
                  
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>"; // Close product-row
            } else {
                echo "No products found in this category.";
            }
        }
        
        ?>
        
        <!-- HTML Structure -->
    
        <div class="category-sections">
        
            <div class="category-section" >
            <h2>Latest Products</h2>
       

     
         
<!-- Product cards will be dynamically added here -->
<div class="products-container" id="products-container">  <div class="product-card"></div></div>

              




            
            <!-- Add more sections for additional categories as needed -->
        </div>
       
        
        <?php
        // Close the database connection
        $conn->close();
        ?>
        
        </div> 
        </div>
  

   

    <!-- Footer Starts  -->
    <footer>
        <div class="foot-panel1">
            Back to Top
        </div>
        <div class="foot-panel2">
            <ul>
                <p>Get to Know Us</p>
                <a>Care

ers</a>
                <a>Blog</a>
                <a>About Amazon</a>
                <a>Investor Relations</a>
                <a>Amazon Devices</a>
                <a>Amazon Science</a>


            </ul>

            <ul>
                <p>Make Money with Us</p>
                <a> Sell products on Amazon</a>
                <a> Sell on Amazon Business</a>
                <a>Sell apps on Amazon</a>
                <a>Become an Affiliates</a>
                <a> Advertise Your Products</a>
                <a> Self-Publish with Us</a>
                <a> Host an Amazon Hub</a>
                <a> See More Make Money with Us</a>

            </ul>

            <ul>


                <p>Amazon Payment Products</p>
                <a>Amazon Business Card</a>
                <a>Shop with Points</a>
                <a>Reload Your Balance</a>
                <a>Amazon Currency Converter</a>

            </ul>

            <ul>
                <p>Let Us Help You</p>
                <a>Amazon and COVID-19</a>
                <a>Your Account</a>
                <a>Your Orders</a>
                <a>Shipping Rates & Policies</a>
                <a>Returns & Replacements</a>
                <a>Manage Your Content and Devices</a>
                <a>Amazon Assistant</a>

            </ul>



        </div>
        <div class="foot-panal3">
            <div class="logo"></div>

        </div>
        <div class="foot-panel4">
            <div class="pages">
                <a>Conditions of Use</a>
                <a>Privacy Notice</a>
                <a>Your Ads Privacy Choices</a>


            </div>
            <div class="copyright">
                © 1996-2024, Amazon.com, Inc. or its affiliates
            </div>
        </div>
    </footer>

   


    <!-- FooterEnds -->
  






    <script>




        function addProduct() {
            // Simulate adding a product from the admin panel
            const productContainer = document.getElementById('product-container');
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            productCard.innerHTML = `
            <img src="path_to_your_image.jpg" alt="Product Image">
            <div class="product-details">
                <div class="product-name">Product Name</div>
                <div class="product-price">$10.00</div>
                <div class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                <button onclick="addToCart(1)">Add to Cart</button>
            </div>
        `;
            productContainer.appendChild(productCard);

            // Adjust the size of .panel and .panel-ops
            adjustPanelSize();
        }

        function removeProduct() {
            // Simulate removing a product from the admin panel
            const productContainer = document.getElementById('product-container');
            if (productContainer.lastChild) {
                productContainer.removeChild(productContainer.lastChild);

                // Adjust the size of .panel and .panel-ops
                adjustPanelSize();
            }
        }

        // Function to adjust the size of .panel and .panel-ops
        function adjustPanelSize() {
            const panel = document.querySelector('.panel');
            const panelOps = document.querySelector('.panel-ops');
            const productContainer = document.getElementById('product-container');
            const productContainerHeight = productContainer.offsetHeight;
            panel.style.height = productContainerHeight + 'px';
            panelOps.style.height = productContainerHeight + 'px';
        }







      

   // Function to update cart count
   function updateCartCount() {
            fetch('get_cart_count.php')
            .then(response => response.text())
            .then(count => {
                document.getElementById('cart-count').textContent = count;
            });
        }

        // Function to add product to cart
        // Function to add product to cart
function addToCart(productId) {
    fetch('add_to_cart.php?id=' + productId)
    .then(response => {
        if (response.ok) {
            alert('Product added to cart successfully!');
            updateCartCount(); // Update cart count after adding product
        } else {
            alert('Failed to add product to cart. Please try again.');
        }
    });
}

         // Function to add product box to the webpage
        




        // Function to fetch categories from backend API and create category buttons
        function fetchCategoriesAndCreateButtons() {
            fetch('onlycat.php')
            .then(response => response.json())
            .then(categories => {
                const categoryButtonsContainer = document.getElementById('category-buttons');
                categories.forEach(category => {
                    const button = document.createElement('button');
                    button.textContent = category.name;
                    button.addEventListener('click', () => filterProductsByCategory(category.id));
                    categoryButtonsContainer.appendChild(button);
                });
            });
        }

        // Function to fetch products from backend API and dynamically create product cards
        function fetchProductsAndCreateCards() {
            fetch('get_products.php')
            .then(response => response.json())
            .then(products => {
                const productsContainer = document.getElementById('products-container');
                products.forEach(product => {
                    const productCard = document.createElement('div');
                    productCard.classList.add('product');
                    productCard.innerHTML = `
                        <h2>${product.name}</h2>
                        <img src="${product.image_url}" alt="${product.name}"> <!-- Product Image -->
                        <p>Description: ${product.description}</p>
                        <p>Price: $${product.price}</p>
                        <button onclick="addToCart(${product.id})">Add to Cart</button>
                    `;
                    productsContainer.appendChild(productCard);
                });
            });
        }

        // Function to filter products by category
        function filterProductsByCategory(categoryId) {
            const productsContainer = document.getElementById('products-container');
            productsContainer.innerHTML = ''; // Clear existing products
            fetch('get_products.php')
            .then(response => response.json())
            .then(products => {
                products.forEach(product => {
                    if (product.category_id === categoryId) {
                        const productCard = document.createElement('div');
                        productCard.classList.add('product');
                        productCard.innerHTML = `
                            <h2>${product.name}</h2>
                            <img src="${product.image_url}" alt="${product.name}"> <!-- Product Image -->
                            <p>Description: ${product.description}</p>
                            <p>Price: $${product.price}</p>
                            <button onclick="addToCart(${product.id})">Add to Cart</button>
                        `;
                        productsContainer.appendChild(productCard);
                    }
                });
            });
        }

        // Call updateCartCount function when the page loads to display the current cart count
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount(); // Update cart count
            fetchCategoriesAndCreateButtons(); // Fetch categories and create category buttons
            fetchProductsAndCreateCards(); // Fetch all products and create product cards
        });



        

        // Fetch products from the admin panel
        function fetchProducts() {
            fetch('get_products.php') // Update the URL to your backend endpoint
            .then(response => response.json())
            .then(products => {
                products.forEach(product => {
                    addProductBox(product);
                });
            })
            .catch(error => console.error('Error fetching products:', error));
        }

        // Call fetchProducts function when the page loads
        window.onload = fetchProducts;


    </script>
</body>

</html>