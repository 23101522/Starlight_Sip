<?php require_once 'init.php'; ?>
<?php
include 'db.php';

$result = $conn->query("SELECT * FROM complaints ORDER BY created_at DESC");
$complaints = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $complaints[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - View Complaints</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }
        .complaint {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 15px;
        }
        .complaint h4 {
            margin: 0;
        }
        .complaint .text {
            margin-top: 10px;
        }
        .complaint .date {
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>

<h2>📢 Customer Complaints</h2>

<?php if (empty($complaints)): ?>
    <p>No complaints yet.</p>
<?php else: ?>
    <?php foreach ($complaints as $c): ?>
        <div class="complaint">
            <h4><?= htmlspecialchars($c['name']) ?></h4>
            <p class="text"><?= nl2br(htmlspecialchars($c['complaint'])) ?></p>
            <p class="date">Submitted on: <?= $c['created_at'] ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
