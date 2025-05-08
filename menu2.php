<?php
include 'db.php';

// Get all coffees from the database
$sql = "SELECT * FROM coffees";
$result = $conn->query($sql);

// Separate coffees by category
$hotCoffees = [];
$coldCoffees = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (strtolower($row['category']) === 'hot') {
            $hotCoffees[] = $row;
        } elseif (strtolower($row['category']) === 'cold') {
            $coldCoffees[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Our Coffee Menu</title>
  <link rel="stylesheet" href="style.css">
  
</head>
<body>

<h1>☕ Our Menu</h1>
<style>body {
  font-family: Arial, sans-serif;
  background: #fffdf8;
  margin: 0;
  padding: 20px;
  text-align: center;
}

h1 {
  margin-bottom: 10px;
}

h2 {
  margin-top: 30px;
  color: #444;
}

.button-row {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-bottom: 30px;
}

.menu-button {
  background-color: #e0c097;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.menu-button:hover {
  background-color: #d4a373;
}

.menu-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}

.menu-item {
  border: 1px solid #ccc;
  border-radius: 10px;
  width: 250px;
  padding: 15px;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.menu-item img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
}

.stars {
  color: gold;
  font-size: 18px;
  margin-top: 5px;
}
</style>
<div class="button-row">
  <form action="review.php" method="GET">
    <input type="submit" value="Reviews" class="menu-button" />
  </form>
  <form action="reservation.php" method="GET">
    <input type="submit" value="Reservation" class="menu-button" />
  </form>
</div>

<h2>🔥 Hot Drinks</h2>
<div class="menu-container">
<?php foreach ($hotCoffees as $coffee): ?>
  <div class="menu-item">
    <img src="<?= htmlspecialchars($coffee['image']) ?>" alt="<?= htmlspecialchars($coffee['name']) ?>">
    <h3><?= htmlspecialchars($coffee['name']) ?></h3>
    <p><?= htmlspecialchars($coffee['description']) ?></p>
    <p><strong>$<?= number_format($coffee['price'], 2) ?></strong></p>
    <div class="stars">⭐⭐⭐⭐☆</div> <!-- Example static rating -->
  </div>
<?php endforeach; ?>
</div>

<h2>❄️ Cold Drinks</h2>
<div class="menu-container">
<?php foreach ($coldCoffees as $coffee): ?>
  <div class="menu-item">
    <img src="<?= htmlspecialchars($coffee['image']) ?>" alt="<?= htmlspecialchars($coffee['name']) ?>">
    <h3><?= htmlspecialchars($coffee['name']) ?></h3>
    <p><?= htmlspecialchars($coffee['description']) ?></p>
    <p><strong>$<?= number_format($coffee['price'], 2) ?></strong></p>
    <div class="stars">⭐⭐⭐☆☆</div> <!-- Example static rating -->
  </div>
<?php endforeach; ?>
</div>

</body>
</html>
