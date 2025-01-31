<?php
session_start();

// Dummy user authentication
if (!isset($_SESSION['username'])) {
    // Redirect to login if user is not logged in
    header('Location: login.php');
    exit;
}

// Simulated user data (in a real application, this would be retrieved from a database)
$users = [
    'user1' => ['password' => 'password1'],
    'user2' => ['password' => 'password2'],
];

// Fetch the logged-in user's data
$current_user = $_SESSION['username'];

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'] ?? '';

    // Vulnerable: No CSRF token validation
    if (!empty($new_password)) {
        // Simulating password update
        $users[$current_user]['password'] = $new_password;

        echo "<div class='alert alert-success'>Password changed successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Password cannot be empty.</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Change Password</title>
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
            <h3>Change Password</h3>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
            <hr>
            <h4>CSRF Simulation:</h4>
            <p>An attacker could craft a malicious HTML form to send a POST request to this page, changing the user's password without their knowledge.</p>
        </div>
    </div>
</body>
</html>
