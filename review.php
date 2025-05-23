<?php require_once 'init.php'; ?>
<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Submit review logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Insert the review into the database
    $stmt = $conn->prepare("INSERT INTO reviews (name, rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $rating, $comment);

    if ($stmt->execute()) {
        $success = "✅ Review submitted successfully!";
    } else {
        $error = "❌ Failed to submit review: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all reviews from the database
$reviews = [];
$result = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave a Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            padding: 40px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 0px 10px #aaa;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
        }
        .message {
            margin-top: 15px;
            color: green;
        }
        .error {
            color: red;
        }
        .reviews-section {
            margin-top: 40px;
        }
        .review {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        .review h4 {
            margin: 0;
            color: #333;
        }
        .review .rating {
            color: gold;
        }
        .review .comment {
            margin-top: 10px;
            font-size: 14px;
        }
        .review .date {
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Leave a Review</h2>
    <?php if (!empty($success)) echo "<div class='message'>$success</div>"; ?>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <label>Your Name:</label>
        <input type="text" name="name" required>

        <label>Rating (1 to 5):</label>
        <select name="rating" required>
            <option value="">--Select--</option>
            <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
        </select>

        <label>Comment:</label>
        <textarea name="comment" rows="4" required></textarea>

        <button type="submit">Submit Review</button>
    </form>
</div>

<!-- Reviews Section -->
<div class="reviews-section">
    <h2>Customer Reviews</h2>
    <?php if (empty($reviews)) : ?>
        <p>No reviews yet. Be the first to leave a review!</p>
    <?php else : ?>
        <?php foreach ($reviews as $review) : ?>
            <div class="review">
                <h4><?php echo htmlspecialchars($review['name']); ?> <span class="rating">⭐ <?php echo $review['rating']; ?></span></h4>
                <p class="comment"><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                <p class="date">Posted on: <?php echo $review['created_at']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>