<?php
include 'db.php';

$sql = "SELECT * FROM tables";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tables for Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h1>🍽️ Tables for Reservation</h1>

<?php if ($result && $result->num_rows > 0): ?>
    <?php while ($table = $result->fetch_assoc()): ?>
        <div class="table">
            <h2>Table No: <?= htmlspecialchars($table["TABLE_NO"]) ?></h2>
            <h3>Seats: <?= htmlspecialchars($table["SEAT_NO"]) ?></h3>
            
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No tables available for reservation.</p>
<?php endif; ?>
<?php
/*include "db.php"; // connects to database

// Get total reserved seats so far
$totalReserved = 0;
$result = $conn->query("SELECT SUM(seats) AS total FROM reservations");
if ($row = $result->fetch_assoc()) {
    $totalReserved = $row['total'] ?? 0;
}

$maxCapacity = 18;
$availableSeats = $maxCapacity - $totalReserved;

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $seats = (int)$_POST['seats'];

    if ($seats <= 0 || $seats > 3) {
        $message = "You can reserve between 1 and 3 seats only.";
    } elseif ($seats > $availableSeats) {
        $message = "Only $availableSeats seats are available.";
    } else {
        $stmt = $conn->prepare("INSERT INTO reservations (name, seats) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $seats);
        $stmt->execute();
        $stmt->close();
        header("Location: reservation.php"); // refresh to show updated seats
        exit();
    }
}
?>

<?php

// Get total reserved seats so far
$totalReserved = 0;
$result = $conn->query("SELECT SUM(seats) AS total FROM reservations");
if ($row = $result->fetch_assoc()) {
    $totalReserved = $row['total'] ?? 0;
}

$maxCapacity = 18;
$availableSeats = $maxCapacity - $totalReserved;

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $seats = (int)$_POST['seats'];

    if ($seats <= 0 || $seats > 3) {
        $message = "You can reserve between 1 and 3 seats only.";
    } elseif ($seats > $availableSeats) {
        $message = "Only $availableSeats seats are available.";
    } else {
        $stmt = $conn->prepare("INSERT INTO reservations (name, seats) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $seats);
        $stmt->execute();
        $stmt->close();
        header("Location: reservation.php"); // refresh to show updated seats
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserve Your Seat</title>
    <style>
        body { font-family: Arial; background: #fdf6ec; padding: 20px; }
        .form-box { background: #fff; padding: 20px; max-width: 400px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        input[type="text"], input[type="number"] { width: 100%; padding: 10px; margin: 10px 0; }
        input[type="submit"] { background: #a9744f; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #8d5f3f; }
        .message { color: red; text-align: center; }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Reserve Your Seat</h2>
    <p>Available Seats: <strong><?= $availableSeats ?></strong> / 18</p>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if ($availableSeats > 0): ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="number" name="seats" min="1" max="3" placeholder="Seats (max 3)" required />
        <input type="submit" value="Reserve">
    </form>
    <?php else: ?>
        <p class="message">Sorry! All seats are reserved.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php $conn->close(); ?>*/
?>





