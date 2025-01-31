<?php
// Check if 'redirect' parameter exists
if (isset($_GET['redirect'])) {
    $url = $_GET['redirect'];

    // Vulnerable redirection logic
    header("Location: $url");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Redirection Vulnerability</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
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
            <h3>Open Redirection Vulnerability</h3>
            <p>This page demonstrates an open redirection vulnerability.</p>
            <p>Click the button below to simulate an open redirect:</p>
            <form method="GET" action="">
                <input type="hidden" name="redirect" value="https://www.google.com">
                <button type="submit" class="btn btn-primary">Simulate Redirect</button>
            </form>
            <hr>
            <h4>How to exploit:</h4>
            <ul>
                <li>Pass a malicious URL to the <code>redirect</code> parameter, e.g., <code>?redirect=http://malicious-site.com</code>.</li>
                <li>The user will be redirected to the specified URL without validation.</li>
            </ul>
            <p><strong>Note:</strong> This is an educational example to highlight the risks of unsanitized user input in redirection logic.</p>
        </div>
    </div>
</body>
</html>
