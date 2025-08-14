<?php
require 'db.php';

$stmt = $pdo->query("SELECT email, name FROM guests");
$guests = $stmt->fetchAll();

// Set your wedding date
$weddingDate = '2025-08-20';
$today = date('Y-m-d');
$daysToWedding = (strtotime($weddingDate) - strtotime($today)) / 86400;

if ($daysToWedding > 7) {
    echo "Reminders can only be sent within 7 days of the wedding.";
    exit();
}

$subject = "Wedding Reminder";
$headers = "From: brideandgroom@example.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

foreach ($guests as $guest) {
    $to = $guest['email'];
    $message = "Dear {$guest['name']},\n\nWe're excited to see you at our wedding on {$weddingDate}!\n\nLove,\nThe Bride and Groom";

    mail($to, $subject, $message, $headers);
}

echo "Reminder emails sent to " . count($guests) . " guests.";
?>
