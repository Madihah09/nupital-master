<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);

    if ($name && $email) {
        try {
            $stmt = $pdo->prepare("INSERT INTO rsvps (name, email) VALUES (?, ?)");
            $stmt->execute([$name, $email]);
            echo "Thank you for RSVPing!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
}
?>
