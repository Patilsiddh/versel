

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 0 0px;
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
   cursor: pointer;
}

</style>
</head>
<body>

    <div class="login-container">
    <div class="img">
    <img src="https://tse4.mm.bing.net/th?id=OIP.3meF7mC6eHnDmied3AsDTwHaFj&pid=Api&P=0&h=220" alt="">
  </div>
        <h2>Login</h2>
        <form action="FrontPage.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
