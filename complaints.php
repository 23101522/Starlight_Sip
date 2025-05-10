<?php require_once 'init.php'; ?>

<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Submit complaint logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $complaint = $_POST['complaint'];

    // Insert the complaint into the database
    $stmt = $conn->prepare("INSERT INTO complaints (name, complaint) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $complaint);

    if ($stmt->execute()) {
        $success = "✅ Complaint submitted successfully!";
    } else {
        $error = "❌ Failed to submit complaint: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all complaints from the database
$complaints = [];
$result = $conn->query("SELECT * FROM complaints ORDER BY created_at DESC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $complaints[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit a Complaint</title>
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
        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background: #f44336;
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
        .complaints-section {
            margin-top: 40px;
        }
        .complaint {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        .complaint h4 {
            margin: 0;
            color: #333;
        }
        .complaint .complaint-text {
            margin-top: 10px;
            font-size: 14px;
        }
        .complaint .date {
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Submit a Complaint</h2>
    <?php if (!empty($success)) echo "<div class='message'>$success</div>"; ?>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <label>Your Name:</label>
        <input type="text" name="name" required>

        <label>Complaint:</label>
        <textarea name="complaint" rows="4" required></textarea>

        <button type="submit">Submit Complaint</button>
    </form>
</div>

<!-- Complaints Section -->
<div class="complaints-section">
    <h2>Customer Complaints</h2>
    <?php if (empty($complaints)) : ?>
        <p>No complaints yet. Be the first to leave a complaint!</p>
    <?php else : ?>
        <?php foreach ($complaints as $complaint) : ?>
            <div class="complaint">
                <h4><?php echo htmlspecialchars($complaint['name']); ?></h4>
                <p class="complaint-text"><?php echo nl2br(htmlspecialchars($complaint['complaint'])); ?></p>
                <p class="date">Submitted on: <?php echo $complaint['created_at']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>