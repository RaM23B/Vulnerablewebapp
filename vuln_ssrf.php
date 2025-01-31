<?php
session_start();

// Function to simulate fetching content
function fetchURL($url) {
    $simulated_endpoints = [
        "http://localhost/admin-panel" => "Admin Panel: Access Granted!",
        "http://localhost/secret-api"  => "Internal API: Sensitive Data Here.",
        "http://localhost/config"      => "Configuration File: db_password=123456",
        "http://127.0.0.1:8000"        => "Internal Service: Port 8000 Running",
        "file:///etc/passwd"           => "root:x:0:0:root:/root:/bin/bash\nnobody:x:65534:65534:nobody:/nonexistent:/usr/sbin/nologin",
    ];

    // Return pre-simulated content or fetch actual content
    if (array_key_exists($url, $simulated_endpoints)) {
        return $simulated_endpoints[$url];
    } elseif (filter_var($url, FILTER_VALIDATE_URL)) {
        $content = @file_get_contents($url);
        return $content !== false ? $content : "Failed to fetch content.";
    } else {
        return "Invalid or blocked URL.";
    }
}

// Handle the POST request
$response = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url'])) {
    $url = $_POST['url'];
    $response = fetchURL($url);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSRF Vulnerability</title>
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
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card p-4">
        <h1 class="mb-4 text-danger text-center">SSRF Vulnerability</h1>
        <p>
            This page demonstrates a **Server-Side Request Forgery (SSRF)** vulnerability.
            An attacker can send requests to internal systems or unauthorized endpoints through this server.
        </p>

        <h5 class="mt-4">Fetch URL Content</h5>
        <form method="POST">
            <div class="mb-3">
                <label for="url" class="form-label">Target URL</label>
                <input type="text" name="url" id="url" class="form-control" placeholder="e.g., http://localhost/admin-panel" required>
            </div>
            <button type="submit" class="btn btn-danger w-100">Fetch Content</button>
        </form>

        <?php if ($response): ?>
            <div class="alert alert-info mt-4">
                <strong>Response:</strong>
                <pre><?php echo htmlspecialchars($response); ?></pre>
            </div>
        <?php endif; ?>
    </div>

    <div class="alert alert-warning mt-4">
        <strong>How it works:</strong> This form accepts any **URL** without validation. It allows attackers to fetch restricted content or internal server resources.
    </div>

    <div class="card mt-4 p-3">
        <h5>Try these example endpoints:</h5>
        <ul>
            <li><code>http://localhost/admin-panel</code></li>
            <li><code>http://localhost/secret-api</code></li>
            <li><code>http://localhost/config</code></li>
            <li><code>http://127.0.0.1:8000</code></li>
            <li><code>file:///etc/passwd</code></li>
            <li><code>https://example.com</code></li>
        </ul>
    </div>
</div>
</body>
</html>
