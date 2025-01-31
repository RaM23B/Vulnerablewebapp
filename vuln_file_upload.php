<?php
if (isset($_POST['upload'])) {
    $file = $_FILES['file'];
    $destination = "uploads1/" . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $destination);
    echo "<div class='alert alert-success'>File uploaded: <a href='$destination'>$destination</a></div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>File Upload Demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">File Upload Demo</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" class="form-control mb-3" required>
        <button type="submit" name="upload" class="btn btn-warning">Upload</button>
    </form>
</div>
</body>
</html>
