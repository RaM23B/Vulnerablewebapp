<?php
$output = '';
if (isset($_POST['ping'])) {
    $target = $_POST['target'];
    $output = shell_exec("ping -c 2 $target");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Command Injection Vulnerability Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 60%;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
        a {
            text-decoration: none;
            color: #333;
        }
        .info {
            background-color: #ffeb3b;
            padding: 15px;
            border-radius: 8px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Command Injection Vulnerability Demonstration</h1>
    </header>

    <div class="container">
        <h2>Ping a Host</h2>
        <p>Enter an IP address or domain to ping:</p>
        <form method="post">
            <div class="form-group">
                <input type="text" name="target" placeholder="Enter IP or domain" required>
            </div>
            <button type="submit" name="ping">Ping</button>
        </form>

        <?php if ($output): ?>
            <h3>Output:</h3>
            <pre><?php echo htmlspecialchars($output); ?></pre>
        <?php endif; ?>
    </div>

    <footer>
        <p><a href="index.php">Back</a></p>
    </footer>

    <div class="container">
        <h3>Explanation of the Vulnerability</h3>
        <p>This page demonstrates a <strong>Command Injection vulnerability</strong>. The user input from the "target" field is directly used in a shell command without proper sanitization. An attacker can inject arbitrary commands into the system by modifying the input, potentially gaining control of the server.</p>
        <p><strong>For example:</strong></p>
        <pre>example.com; ls -la</pre>
        <p>This would execute the <code>ping</code> command on "example.com", but it would also run a <code>ls -la</code> command to list files on the server, which could lead to further attacks.</p>
        <p><strong>How to Fix:</strong> Always sanitize user input and avoid directly passing it to system commands. You can use functions like <code>escapeshellarg()</code> to properly escape the input and prevent command injection.</p>
    </div>

    <div class="info">
        <h4>Important Note:</h4>
        <p>This demonstration is for educational purposes only. If you’re developing a real-world application, never use raw user input in system commands. Always sanitize and validate input before executing it in a shell command.</p>
    </div>
</body>
</html>
