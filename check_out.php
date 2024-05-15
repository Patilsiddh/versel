


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            background-color: rgb(241, 196, 31);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(241, 196, 31);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Products</h2>
    <div id="products"></div>
    <h3>Total Price: <span id="total_price"></span></h3>
    <div class="container">
        <h1>Checkout</h1>
        <form id="checkout-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="address">Delivery Address:</label>
            <input type="text" id="address" name="address" required>
            <label for="delivery_date">Delivery Date:</label>
            <input type="date" id="delivery_date" name="delivery_date" required>
        
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="">Select Payment Method</option>
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <option value="paypal">PayPal</option>
            </select>
            <div id="debit_card_info" class="hidden">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv">
                <label for="expiry_date">Expiry Date:</label>
                <input type="month" id="expiry_date" name="expiry_date">
            </div>
            <br><br>
            <button type="submit">Place Order</button>
        </form>
        <div id="response"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchProducts();
            document.getElementById('payment_method').addEventListener('change', toggleDebitCardFields);
        });

        function fetchProducts() {
            fetch('PaymentDisplay.php')
                .then(response => response.json())
                .then(data => {
                    const productsDiv = document.getElementById('products');
                    let totalPrice = 0;
                    let productsHTML = '<table>';
                    productsHTML += '<tr><th>Name</th><th>Price</th></tr>';
                    data.forEach(product => {
                        productsHTML += `<tr><td>${product.name}</td><td>${product.price}</td></tr>`;
                        totalPrice += parseFloat(product.price);
                    });
                    productsHTML += '</table>';
                    productsDiv.innerHTML = productsHTML;
                    document.getElementById('total_price').textContent = totalPrice.toFixed(2);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function toggleDebitCardFields() {
            const paymentMethod = document.getElementById('payment_method').value;
            const debitCardInfo = document.getElementById('debit_card_info');
            if (paymentMethod === 'debit_card') {
                debitCardInfo.classList.remove('hidden');
            } else {
                debitCardInfo.classList.add('hidden');
            }
        }

        document.getElementById('checkout-form').addEventListener('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(this);

            let summary = 'Order Summary\n\n';
            summary += 'Customer Details:\n';
            summary += `Name: ${formData.get('name')}\n`;
            summary += `Email: ${formData.get('email')}\n`;
            summary += `Delivery Address: ${formData.get('address')}\n`;
            summary += `Delivery Date: ${formData.get('delivery_date')}\n`;
            summary += `Payment Method: ${formData.get('payment_method')}\n`;
            summary += '\nProducts:\n';
            const products = document.querySelectorAll('#products table tr');
            products.forEach((row, index) => {
                if (index > 0) { // Skip the header row
                    const cols = row.querySelectorAll('td');
                    summary += `Product Name: ${cols[0].textContent}, Price: ${cols[1].textContent}\n`;
                }
            });
            summary += `\nTotal Price: ${document.getElementById('total_price').textContent}`;

            alert(summary);
            fetch('checkout.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('response').innerHTML = data;
                window.location.href = 'FrontPage.php';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
