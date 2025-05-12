<?php require_once 'init.php'; ?>
<?php include 'db.php'; ?>

<?php
// Handle review deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_review'])) {
    $id = $_POST['review_id'];
    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all reviews
$reviews = [];
$result = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fdf7f0;
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        h2 {
            color: #5a3e2b;
        }
        .btn {
            padding: 8px 14px;
            margin-left: 10px;
            text-decoration: none;
            background: #81c784;
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn.logout {
            background: #e57373;
        }
        .btn.back {
            background: #64b5f6;
        }

        .review {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
        }
        .review h4 {
            margin: 0;
            color: #333;
        }
        .rating {
            color: #f1c40f;
            font-weight: bold;
        }
        .comment {
            margin: 10px 0;
        }
        .date {
            font-size: 12px;
            color: #777;
        }
        .delete-form {
            margin-top: 10px;
        }
        .delete-btn {
            background: #e57373;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>🛠️ Admin - Customer Reviews</h2>
    <div>
        <a href="admin.php" class="btn back">← Back to Dashboard</a>
        <a href="admin_logout.php" class="btn logout">Logout</a>
    </div>
</div>

<?php if (empty($reviews)): ?>
    <p>No customer reviews yet.</p>
<?php else: ?>
    <?php foreach ($reviews as $review): ?>
        <div class="review">
            <h4><?= htmlspecialchars($review['name']) ?> 
                <span class="rating">⭐ <?= $review['rating'] ?></span>
            </h4>
            <p class="comment"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
            <p class="date">Posted on: <?= $review['created_at'] ?></p>
            <form method="POST" class="delete-form">
                <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
                <input type="submit" name="delete_review" value="Delete" class="delete-btn">
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
