<?php
session_start();
require 'config.php';
require 'auth.php'; // Ensure user is logged in

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM materials WHERE user_id = ?");
$stmt->execute([$user_id]);
$materials = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Uploads</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Your Uploaded Materials</h2>
    <?php if ($materials): ?>
      <ul class="list-group">
        <?php foreach ($materials as $material): ?>
          <li class="list-group-item">
            <strong><?= htmlspecialchars($material['title']); ?></strong>
            (<?= htmlspecialchars($material['category']); ?>)
            - Uploaded on <?= htmlspecialchars($material['created_at']); ?>
            <a href="uploads/<?= htmlspecialchars($material['file_path']); ?>" target="_blank" class="btn btn-sm btn-success float-end">View</a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>No materials uploaded yet.</p>
    <?php endif; ?>
  </div>
</body>
</html>
