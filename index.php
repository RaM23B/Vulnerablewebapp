<?php
session_start();

// Handle logout
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable E-Commerce App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding: 20px;
            width: 250px;
        }
        .sidebar h2 {
            color: #ffc107;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
            font-size: 18px;
        }
        .sidebar a:hover {
            color: #ffc107;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .card {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            margin-top: 20px;
            padding: 10px 0;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
            text-align: center;
        }
        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Vulnerable App</h2>
    <a href="?page=home">Home</a>
    <a href="?page=sql_injection">SQL Injection</a>
    <a href="?page=file_upload">File Upload</a>
    <a href="?page=command_injection">Command Injection</a>
    <a href="?page=csrf">CSRF</a>
    <a href="?page=ssrf">SSRF</a>
    <a href="?page=cors">CORS</a>
    <a href="?page=xss">XSS</a>
    <a href="?page=parameter_pollution">HTTP Parameter Pollution</a>
    <a href="?page=response_splitting">HTTP Response Splitting</a>
    <a href="?page=vul_change_password">Change Password (CSRF)</a>
    <a href="?page=vul_open_redirect">Open Redirection</a>
    <a href="?page=vul_back_refresh">Back and Refresh Attack</a>
    <a href="?logout=1" class="text-danger">Logout</a>
</div>

<!-- Main Content -->
<div class="content">
    <?php
    if (!isset($_SESSION['user_id'])) {
        echo "<div class='card p-4'>
                <h3>Welcome!</h3>
                <p>Please <a href='login.php'>login</a> or <a href='register.php'>register</a> to access the vulnerabilities.</p>
              </div>";
    } else {
        $page = $_GET['page'] ?? 'home';

        // Dynamic page routing
        if ($page === 'home') {
            echo "<div class='card p-4'>
                    <h3>Welcome to the Vulnerable E-Commerce Application</h3>
                    <p>This application is intentionally designed for security testing and educational purposes. Below are the vulnerabilities you can explore:</p>
                    <ul>
                        <li><strong>SQL Injection</strong>: Manipulate SQL queries.</li>
                        <li><strong>File Upload</strong>: Improper file upload validation.</li>
                        <li><strong>Command Injection</strong>: Inject system commands.</li>
                        <li><strong>CSRF</strong>: Cross-site request forgery.</li>
                        <li><strong>SSRF</strong>: Server-side request forgery.</li>
                        <li><strong>CORS</strong>: Misconfigured cross-origin resource sharing.</li>
                        <li><strong>XSS</strong>: Cross-site scripting attacks.</li>
                        <li><strong>HTTP Response Splitting</strong>: Exploit improper header handling.</li>
                        <li><strong>HTTP Parameter Pollution</strong>: Manipulate multiple parameters with the same name.</li>
                        <li><strong>Change Password (CSRF)</strong>: Demonstrates CSRF vulnerability while changing the password.</li>
                    </ul>
                    <p><strong>Disclaimer:</strong> This application is for <span class='text-danger'>educational purposes only</span>. The author is not responsible for any misuse.</p>
                  </div>";
        } elseif ($page === 'sql_injection') {
            include('vuln_sql_injection.php');
        } elseif ($page === 'file_upload') {
            include('vuln_file_upload.php');
        } elseif ($page === 'command_injection') {
            include('vuln_command_injection.php');
        } elseif ($page === 'csrf') {
            include('vuln_csrf.php');
        } elseif ($page === 'ssrf') {
            include('vuln_ssrf.php');
        } elseif ($page === 'cors') {
            include('vuln_cors.php');
        } elseif ($page === 'xss') {
            include('vul_xss.php');
        } elseif ($page === 'parameter_pollution') {
            include('vul_paramterpollution.php');
        } elseif ($page === 'response_splitting') {
            include('vul_response_split.php');
        } elseif ($page === 'vul_change_password') {
            include('vul_change_password.php');
        } elseif ($page === 'vul_open_redirect') {
            include('vul_open_redirect.php');
        } elseif ($page === 'vul_back_refresh') {
            include('vul_back_refresh.php');    
        } else {
            echo "<div class='alert alert-danger'>Page not found.</div>";
        }
    }
    ?>
</div>
<!-- Footer -->
<footer>
    <p>&copy; 2024 Made by <strong>RR</strong></p>
</footer>
</body>
</html>
