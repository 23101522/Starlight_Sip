<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rsvp'])) {
    $event_id   = $_POST['event_id'] ?? null;
    $full_name  = $_POST['full_name'] ;
    $student_id = $_POST['student_id'] ?? null;

    if ($event_id && $full_name && $student_id) {
        // Optional: Prevent duplicate registration
        $check = $conn->prepare("SELECT * FROM event_participants WHERE event_id = ? AND student_id = ?");
        $check->bind_param("is", $event_id, $student_id);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows === 0) {
            $stmt = $conn->prepare("INSERT INTO event_participants (event_id, full_name, student_id) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $event_id, $full_name, $student_id);
            $stmt->execute();
            echo "<h3 style='color: green;'>✅ You have successfully registered for the event.</h3>";
            $stmt->close();
        } else {
            echo "<h3 style='color: orange;'>⚠️ You are already registered for this event.</h3>";
        }

        $check->close();
    } else {
        echo "<h3 style='color: red;'>❌ Please fill in all fields.</h3>";
    }
}
?>