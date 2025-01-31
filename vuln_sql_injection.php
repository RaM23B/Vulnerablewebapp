<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'vulnerable_ecommerce');

// Vulnerable SQL Query
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $result = $conn->query("SELECT * FROM products WHERE name LIKE '%$search%'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SQL Injection Demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">SQL Injection Demo</h2>
    <form method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Search Products" class="form-control" required>
        <button type="submit" class="btn btn-danger mt-2">Search</button>
    </form>
    <?php if (isset($result)) { ?>
        <h4>Results:</h4>
        <ul class="list-group">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <li class="list-group-item"><?= htmlspecialchars($row['name']) ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
</body>
</html>
