<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate if all required fields are filled
    if (empty($name) || empty($email) || empty($password)) {
        $message = "All fields are required.";
    } else {
        // Insert into database
        $sql = "INSERT INTO users (username, email) VALUES ('$name', '$email' )";

        if ($conn->query($sql) === TRUE) {
            $message = "Sign up successful!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
   
        }

        .container {
            max-width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                     
    position: absolute;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30vw;
    background: white;
    border-radius: 10px;
    border: 2px solid black;
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
  
    border: 2px solid black;
        }

        button {
            background-color: rgb(241, 196, 31);
      width: 240px;
      height: 28px;
      cursor: pointer;
  
        }
     

        button:hover {
          cursor: pointer;;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }
        .img{
   
   justify-content: center;
   display: flex;
 
  }

    </style>
</head>
<body>
<div class="img">
    <img src="https://tse4.mm.bing.net/th?id=OIP.3meF7mC6eHnDmied3AsDTwHaFj&pid=Api&P=0&h=220" alt="">
  </div>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <?php if (!empty($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
            <script>
                alert("<?php echo $message; ?>");
                window.location.href = "signin.php"; // Redirect to signin.php after clicking OK
            </script>
        <?php } ?>
        <div class="login-link">
            <p>Already have an account? <a href="Login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
