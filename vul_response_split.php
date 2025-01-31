<!DOCTYPE html>
<html>
<head>
    <title>HTTP Response Splitting</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="text-danger">HTTP Response Splitting</h1>
    <p>This vulnerability exploits improperly sanitized headers, allowing attackers to inject additional headers or manipulate responses.</p>
    <form method="GET">
        <div class="mb-3">
            <label for="redirect" class="form-label">Redirect URL</label>
            <input type="text" class="form-control" id="redirect" name="redirect" placeholder="Enter a redirect URL">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
    if (isset($_GET['redirect'])) {
        $redirect = $_GET['redirect'];
        header("Location: $redirect"); // Vulnerable to response splitting
        exit;
    }
    ?>
</div>
</body>
</html>
