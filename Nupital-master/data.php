<?php
// data.php

// 1. Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    die("Access denied.");
}

// 2. Sanitize and validate input
$name  = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');

if (empty($name) || empty($email)) {
    die("Please fill in both name and email.");
}

// Optional: Basic email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// 3. Database connection
$host = 'localhost';
$db   = 'wedding';        // ← Replace with your database name
$user = 'roots';        // ← Replace with your database user
$pass = '';    // ← Replace with your database password
$charset = 'utf8mb4';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // 4. Insert into database
    $stmt = $pdo->prepare("INSERT INTO rsvps (name, email) VALUES (?, ?)");
    $stmt->execute([$name, $email]);

    // 5. Redirect to thank you or home
    header("Location: thank-you.html");  // ← Create this page or change as needed
    exit;

}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Thank you for your RSVP!</h1>
        <p>We can't wait to celebrate with you on June 28, 2026!</p>
        <a href="index.html" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>
