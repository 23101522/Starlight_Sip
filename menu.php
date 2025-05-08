<?php
include 'db.php';

$sql = "SELECT * FROM coffees order by category";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Coffee Menu</title>
  <style>
    .menu-item {
      border: 1px solid #ccc;
      padding: 15px;
      margin: 15px;
      border-radius: 10px;
      max-width: 300px;
      display: inline-block;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .menu-item img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
    }
    body {
      font-family: Arial, sans-serif;
      background: #fffdf8;
      text-align: center;
    }
    .menu-category {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
    }

  input[type="submit"] {
    background-color: palegoldenrod;
    color: black;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s;
    display: inline-block;
    margin-bottom: 20px;
    cursor: pointer;
  }

  input[type="submit"] :hover{
    background-color: gold;
  }
  .button-row {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-bottom: 20px;
}

.menu-button {
  padding: 10px 20px;
  cursor: pointer;
  background-color: #e0c097;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.menu-button:hover {
  background-color: #d4a373;
}


  </style>
</head>
<body>

<h1>☕ Coffee Menu</h1>

<div class="button-row">
  <form action="review.php" method="GET">
    <input type="submit" value="Reviews" class="menu-button" />
  </form>
  <form action="reservation.php" method="GET">
    <input type="submit" value="Reservation" class="menu-button" />
  </form>
</div>
  


<?php
/*This starts a <div> element with a class name menu-category.

You can use CSS to style all items under this category, such as:

Adding spacing

Changing layout

Grouping coffee items visually

This div will typically wrap around all menu items in that category.*/
$menu=[];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
        { $cat=$row['category'];
          $menu[$cat][]=$row;}
    }?>
<?php if (!empty($menu)): ?>
  <?php foreach ($menu as $category => $items): ?>
    <h2><?= htmlspecialchars($category) ?></h2>
    <div class="menu-category">
      <?php foreach ($items as $item): ?>
        <div class="menu-item">
          <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" />
          <h3><?= htmlspecialchars($item['name']) ?></h3>
          <p><?= htmlspecialchars($item['description']) ?></p>
          <p><strong><?= number_format($item['price'], 2) ?>TK</strong></p>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p>No coffee items found.</p>
<?php endif; ?>

<?php $conn->close(); ?>
</body>
</html> 

