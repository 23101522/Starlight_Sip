<?php
include "db.php";

// Handle Event Creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $image = $_POST['image'] ?? '';

    if ($title && $date) {
        $stmt = $conn->prepare("INSERT INTO events (title, description, event_date, event_time, image_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $description, $date, $time, $image);
        $stmt->execute();
        $stmt->close();
        $message = "✅ Event added successfully!";
    } else {
        $error = "❌ Title and Date are required.";
    }
}

// Handle Event Deletion
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM events WHERE event_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $message = "🗑️ Event deleted.";
}

// Fetch All Events
$events = $conn->query("SELECT * FROM events ORDER BY event_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Events</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f9f3ec; }
        h2 { color: #5a3e2b; }
        input, textarea { width: 100%; padding: 8px; margin: 6px 0; }
        button { background-color: #5a3e2b; color: white; border: none; padding: 10px 15px; cursor: pointer; }
        button:hover { background-color: #3e2a1e; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .message { margin: 10px 0; padding: 10px; background: #e1f5e1; border: 1px solid #9ccc65; }
        .error { margin: 10px 0; padding: 10px; background: #fce4e4; border: 1px solid #e57373; }
    </style>
</head>
<body>

<h2>🎉 Add New Event</h2>

<?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
<?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

<form method="POST">
    <input type="text" name="title" placeholder="Event Title" required>
    <textarea name="description" placeholder="Event Description"></textarea>
    <input type="date" name="date" required>
    <input type="time" name="time">
    <input type="text" name="image" placeholder="Image URL (optional)">
    <button name="add">Add Event</button>
</form>

<h2>📅 All Events</h2>
<table>
    <tr><th>Title</th><th>Date</th><th>Time</th><th>Action</th></tr>
    <?php while($row = $events->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['event_date']) ?></td>
            <td><?= htmlspecialchars($row['event_time']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= $row['event_id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    <h2>👥 Event Participants</h2>

<?php
$participant_query = "
    SELECT ep.event_id, e.title, ep.name, ep.rsvp_date 
    FROM event_participants ep
    JOIN events e ON ep.event_id = e.event_id
    ORDER BY e.event_id, ep.rsvp_date DESC
";
$participants = $conn->query($participant_query);

$current_event = null;
if ($participants && $participants->num_rows > 0):
    while($row = $participants->fetch_assoc()):
        if ($current_event !== $row['event_id']):
            if ($current_event !== null) echo "</table><br>";
            $current_event = $row['event_id'];
            echo "<h3>📌 " . htmlspecialchars($row['title']) . "</h3>";
            echo "<table border='1'>
                    <tr><th>Name</th><th>RSVP Date</th></tr>";
        endif;
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . $row['rsvp_date'] . "</td>
              </tr>";
    endwhile;
    echo "</table>";
else:
    echo "<p>No participants yet.</p>";
endif;
?>

</table>

</body>
</html>