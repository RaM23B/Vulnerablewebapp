<?php
session_start();

// Handle CORS vulnerability activation
$cors_enabled = false;

if (isset($_GET['enable_cors']) && $_GET['enable_cors'] === '1') {
  $cors_enabled = true;

  // Set CORS headers if enabled
  header("Access-Control-Allow-Origin: *"); // This line allows any origin 
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type");
  header("Content-Type: application/json"); // Removed unnecessary space
}

// Simulated sensitive data endpoint
if (isset($_GET['fetch']) && $_GET['fetch'] === 'data') {
  $data = [
    "user" => "admin",
    "password" => "super_secret_password",
    "token" => "abc123token",
    "message" => "This data is sensitive and should not be exposed cross-origin!"
  ];
  echo json_encode($data);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CORS Vulnerability Demo</title>
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
    .code-block {
      background-color: #f4f4f4;
      padding: 10px;
      border-radius: 5px;
      font-family: monospace;
      color: #333;
      white-space: pre-wrap;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="card p-4">
    <h1 class="mb-4 text-danger text-center">CORS Vulnerability</h1>
    <p>
      This page demonstrates a **Cross-Origin Resource Sharing (CORS)** misconfiguration vulnerability. When CORS is improperly configured, any external website can fetch sensitive data from this server.
    </p>

    <?php if ($cors_enabled): ?>
      <div class="alert alert-warning">
        <strong>Warning:</strong> CORS headers are now enabled! External websites can fetch resources from this server.
      </div>
      <h5 class="mt-4">Fetch Sensitive Data</h5>
      <p>Use this JavaScript snippet on **any external domain** to fetch sensitive data:</p>
      <div class="code-block">
        &lt;script&gt;<br>
        fetch('http://localhost/vuln_cors.php?fetch=data')<br>
        .then(response =&gt; response.json())<br>
        .then(data =&gt; console.log(data))<br>
        .catch(err =&gt; console.error(err));<br>
        &lt;/script&gt;
      </div>
    <?php else: ?>
      <h5 class="mt-4">Simulate the Vulnerability</h5>
      <p>Click the button below to enable CORS headers on this server.</p>
      <form method="get" action="">
        <input type="hidden" name="enable_cors" value="1">
        <button type="submit" class="btn btn-danger w-100">Enable CORS</button>
      </form>
    <?php endif; ?>
  </div>

  <div class="alert alert-info mt-4">
    <strong>How it works:</strong> By enabling `Access-Control-Allow-Origin: *`, this server allows any external website to fetch sensitive data via JavaScript.
  </div>
</div>
</body>
</html>
