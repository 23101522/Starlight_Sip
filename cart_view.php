<?php
$page_title = "Your Cart";
include 'header.php';

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$total = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <style>
        body { font-family: Arial; background: #fdf6ec; padding: 0; margin: 0; }
        .cart-container { max-width: 800px; margin: 20px auto; padding: 20px; }
        .cart-item { 
            display: flex; 
            align-items: center; 
            padding: 15px; 
            border-bottom: 1px solid #ddd;
            background: white;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .cart-item img { width: 80px; height: 80px; object-fit: cover; margin-right: 20px; }
        .cart-item-info { flex-grow: 1; }
        .cart-item-price { font-weight: bold; }
        .cart-total { 
            text-align: right; 
            font-size: 1.2em; 
            margin: 20px 0;
            padding: 15px;
            background: white;
            border-radius: 8px;
        }
        .checkout-btn { 
            background: #6F4E37; 
            color: white; 
            padding: 12px 24px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px; 
            text-decoration: none;
            display: inline-block;
        }
        .checkout-btn:hover { background: #5a3e2b; }
        .quantity-input { width: 50px; text-align: center; }
        .remove-btn { 
            color: #e74c3c; 
            cursor: pointer; 
            margin-left: 10px;
            font-weight: bold;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .empty-cart { 
            text-align: center; 
            padding: 50px;
            background: white;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h1>Your Cart</h1>
        
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <form method="POST" action="cart.php">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="cart-item-info">
                            <h3><?= htmlspecialchars($item['name']) ?></h3>
                            <p><?= number_format($item['price'], 2) ?> TK each</p>
                        </div>
                        <div>
                            <input type="number" name="quantities[<?= $item['id'] ?>]" 
                                   value="<?= $item['quantity'] ?>" min="1" class="quantity-input">
                            <span class="remove-btn" 
                                  onclick="if(confirm('Remove this item?')) window.location.href='cart.php?remove=<?= $item['id'] ?>'">×</span>
                        </div>
                        <div class="cart-item-price">
                            <?= number_format($item['price'] * $item['quantity'], 2) ?> TK
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <!-- Cart Total -->
<div class="cart-total">
    <h3>Total: <?= number_format($total, 2) ?> TK</h3>
</div>

<div class="cart-actions">
    <a href="confirm_cancel.php" class="btn cancel-btn">Cancel Order</a>
    <button type="submit" name="update_cart" class="btn update-btn">Update Cart</button>
    <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
</div>
                </div>
            </form>
        <?php else: ?>
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <br>
                <p>Browse our menu to add delicious items!</p>
                <br>
                <a href="menu.php" class="checkout-btn">View Menu</a>
            </div>
        <?php endif; ?>
    </div>
</body><?php include 'footer.php'; ?>
</html>
