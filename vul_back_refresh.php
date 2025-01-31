<?php
// Simulating a back-and-refresh vulnerability

session_start();

// Initialize order status if not already set
if (!isset($_SESSION['order_status'])) {
    $_SESSION['order_status'] = "No order placed yet.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST['product'] ?? 'Unknown Product';

    // Vulnerable behavior: Directly updating session on submission
    $_SESSION['order_status'] = "Order placed for $product!";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back and Refresh Vulnerability</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <h3>Back and Refresh Attack</h3>
            <p>This example demonstrates how sensitive actions can be unintentionally repeated when users go back or refresh the page.</p>
            
            <h4>Order a Product:</h4>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="product" class="form-label">Select a Product:</label>
                    <select id="product" name="product" class="form-control">
                        <option value="Product A">Product A</option>
                        <option value="Product B">Product B</option>
                        <option value="Product C">Product C</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>

            <hr>
            <h4>Current Order Status:</h4>
            <p><?php echo htmlspecialchars($_SESSION['order_status']); ?></p>
            <p><strong>Disclaimer:</strong> This is for educational purposes only. Do not misuse.</p>
        </div>
    </div>
</body>
</html>
