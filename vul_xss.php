<?php
// Ensure session is active
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reflected and Stored XSS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mb-4">XSS Vulnerabilities</h1>
    <div class="card p-4">
        <h3>Reflected XSS</h3>
        <form method="get" action="">
            <div class="mb-3">
                <label for="search" class="form-label">Search</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Type something...">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php
        // Reflected XSS Vulnerability
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            echo "<p class='mt-3'><strong>Search Results for:</strong> " . htmlspecialchars($search) . "</p>";
            echo "<p>Direct Output (Vulnerable): " . $search . "</p>"; // No sanitization
        }
        ?>
    </div>

    <div class="card p-4">
        <h3>Stored XSS</h3>
        <form method="post" action="">
            <div class="mb-3">
                <label for="comment" class="form-label">Leave a Comment</label>
                <input type="text" id="comment" name="comment" class="form-control" placeholder="Write your comment...">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'vulnerable_ecommerce');
        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        // Handle Stored XSS
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
            $comment = $_POST['comment'];
            $conn->query("INSERT INTO comments (content) VALUES ('$comment')"); // No sanitization
            echo "<p class='text-success mt-3'>Comment added!</p>";
        }

        // Display Comments
        $result = $conn->query("SELECT content FROM comments");
        if ($result && $result->num_rows > 0) {
            echo "<div class='mt-3'><strong>Comments:</strong><ul class='list-group'>";
            while ($row = $result->fetch_assoc()) {
                echo "<li class='list-group-item'>" . $row['content'] . "</li>"; // No sanitization
            }
            echo "</ul></div>";
        } else {
            echo "<p class='mt-3'>No comments yet.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
