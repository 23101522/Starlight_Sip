<?php
include "db.php";

// Fetch all events (use 'title' for event name)
$result = $conn->query("SELECT event_id, title AS event_title, description, event_date, event_time, image_url FROM events");
?>

<!DOCTYPE html>
<html>
<head>
    <title>☕ Events - Starlight Sip</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #fdf7f0; padding: 20px; }
        h1 { color: #5a3e2b; }
        .event-card {
            background: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }
        .event-card h3 { margin-top: 0; }
        input, button {
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background-color: #81c784;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #66bb6a;
        }
    </style>
</head>
<body>

<h1>🎉 Upcoming Events</h1>

<?php while ($row = $result->fetch_assoc()): ?>
    <div class="event-card">
        <h3><?= htmlspecialchars($row['event_title'] ?? 'Untitled Event') ?></h3>
        <p><?= htmlspecialchars($row['description'] ?? 'No description available') ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($row['event_date'] ?? 'No date specified') ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($row['event_time'] ?? 'No time specified') ?></p>

        <?php if ($row['image_url']): ?>
            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Event Image" style="max-width: 100%; height: auto;">
        <?php endif; ?>

        <form method="POST" action="participants.php">
            <input type="hidden" name="event_id" value="<?= $row['event_id'] ?>">
            <input type="text" name="full_name" placeholder="Your Full Name" required>
            <input type="text" name="student_id" placeholder="Student ID" required>
            <button type="submit" name="rsvp">Participate</button>
        </form>
    </div>
<?php endwhile; ?>

</body>
</html>
