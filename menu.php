<?php
include 'db.php';

$sql = "SELECT * FROM coffees order by category";
$result = $conn->query($sql);
?>
<?php 
$page_title = "Coffee Menu";
include 'header.php'; 
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
<br>
<br>
<?php


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
    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
    <h3><?= htmlspecialchars($item['name']) ?></h3>
    <p class="item-description"><?= htmlspecialchars($item['description']) ?></p>
    
    <!-- PRICE AND ADD TO CART FORM GO HERE -->
    <p class="item-price"><?= number_format($item['price'], 2) ?> TK</p>
    
    <form method="POST" action="cart.php" class="add-to-cart-form">
        <input type="hidden" name="coffee_id" value="<?= $item['id'] ?>">
        <input type="number" name="quantity" value="1" min="1" class="quantity-input">
        <button type="submit" name="add_to_cart" class="add-to-cart-btn">
            <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
    </form>
    <!-- END OF PRICE AND ADD TO CART -->
</div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p>No coffee items found.</p>
  <?php endif; ?>


<?php $conn->close(); ?>

</body>
<?php include 'footer.php'; ?>
</html> 

