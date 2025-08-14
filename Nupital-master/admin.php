<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM guests ORDER BY rsvp_date DESC");
$guests = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Wedding Guest List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
  <h2>Guest List</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th><th>Email</th><th>RSVP Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($guests as $guest): ?>
      <tr>
        <td><?= htmlspecialchars($guest['name']) ?></td>
        <td><?= htmlspecialchars($guest['email']) ?></td>
        <td><?= $guest['rsvp_date'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <form action="send-reminders.php" method="POST">
    <button class="btn btn-warning" type="submit">Send Reminder Emails</button>
  </form>
</body>
</html>

