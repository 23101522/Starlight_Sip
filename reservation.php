<?php require_once 'init.php'; ?><?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle new reservation
    if (isset($_POST['username'], $_POST['tables_requested'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $tables_requested = min((int)$_POST['tables_requested'], 6); // limit to 6

        // Get available tables
        $stmt = $conn->prepare("SELECT TABLE_NO FROM tables WHERE RESERVED='AVAILABLE' LIMIT ?");
        $stmt->bind_param("i", $tables_requested);
        $stmt->execute();
        $available = $stmt->get_result();

        while ($row = $available->fetch_assoc()) {
            $table_no = $row['TABLE_NO'];
            $update = $conn->prepare("UPDATE tables SET RESERVED='RESERVED', BOOKED_FOR=? WHERE TABLE_NO=?");
            $update->bind_param("si", $username, $table_no);
            $update->execute();
        }
    }

    // Handle cancel reservation
    if (isset($_POST['cancel_username'])) {
        $cancel_user = htmlspecialchars(trim($_POST['cancel_username']));
        $cancel = $conn->prepare("UPDATE tables SET RESERVED='AVAILABLE', BOOKED_FOR=NULL WHERE BOOKED_FOR=?");
        $cancel->bind_param("s", $cancel_user);
        $cancel->execute();
    }
}

$sql = "SELECT * FROM tables";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Multi-Table Reservation</title>
    <style>
        body { font-family: Arial; }
        .table {
            border: 1px solid #ccc;
            padding: 10px; margin: 10px;
            border-radius: 8px; background-color: #f9f9f9;
        }

        /* Back button styles */
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 15px;
            background-color:white;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background-color:rgb(252, 249, 247);
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .back-btn i {
            margin-right: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <a href="menu.php" class="back-btn" style="color: black;">
    <i class="fas fa-arrow-left"></i> Back to Menu
</a>

<h1>🍽️ Reserve Tables</h1>

<!-- Reservation Form -->
<form action="reservation.php" method="POST">
    <label>USER NAME:</label><br>
    <input type="text" name="username" required><br>

    <label>NUMBER OF TABLES TO RESERVE (max 6):</label><br>
    <input type="number" name="tables_requested" min="1" max="6" required><br><br>

    <input type="submit" value="RESERVE">
</form>

<!-- Cancel Reservation -->
<h3>Cancel Your Reservation</h3>
<form method="POST">
    <label>Enter your username:</label><br>
    <input type="text" name="cancel_username" required>
    <input type="submit" value="CANCEL">
</form>

<!-- Display Tables -->
<h2>📋 Current Table Status</h2>
<?php if ($result && $result->num_rows > 0): ?>
    <?php while ($table = $result->fetch_assoc()): ?>
        <div class="table">
            <h3>Table No: <?= htmlspecialchars($table["TABLE_NO"]) ?></h3>
            <p>Status: <?= htmlspecialchars($table["RESERVED"]) ?></p>

        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No tables found.</p>
<?php endif; ?>

</body>
</html>





