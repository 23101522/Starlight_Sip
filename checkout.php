<?php require_once 'init.php'; ?>

<?php
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: menu.php");
    exit();
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create order
    $email = $_SESSION['email'];
    $stmt = $conn->prepare("INSERT INTO orders (user_email, total_amount) VALUES (?, ?)");
    $stmt->bind_param("sd", $email, $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    
    // Add order items
    foreach ($_SESSION['cart'] as $item) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, coffee_id, quantity, price) 
                               VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }
    
    // Clear cart
    unset($_SESSION['cart']);
    
    // Redirect to payment page
    header("Location: payment_success.php?order_id=$order_id");
    exit();
}
?>

<?php 
$page_title = "Checkout";
include 'header.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <style>
    body { font-family: Arial; background: #fdf6ec; padding: 20px; }
    .checkout-container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }

    .payment-btn {
        width: auto;
        padding: 12px 30px;
        margin: 0;
    }
    .cancel-btn {
        background: #e74c3c !important; color: white; border: none; max-width: 120px;
    }
    .cancel-btn:hover {
        background: #c0392b !important; transform: scale(0.98);
    }
</style>
</head>
<body>
<div class="order-summary">
    <h2>Order Summary</h2>
    <?php foreach ($_SESSION['cart'] as $item): ?>
        <div class="order-item">
            <span><?= htmlspecialchars($item['name']) ?> (×<?= $item['quantity'] ?>)</span>
            <span><?= number_format($item['price'] * $item['quantity'], 2) ?> TK</span>
        </div>
    <?php endforeach; ?>
    <div class="order-total">
        Total: <?= number_format($total, 2) ?> TK
    </div>
</div>
        
        <form method="POST">
    <h2>Payment Method</h2>
    <p>Make a successful payment.</p>
    

    <div class="checkout-actions">
        <a href="cart_view.php" class="payment-btn cancel-btn">Cancel</a>
        <button type="submit" class="payment-btn pay-btn">Place Order</button>
    </div>
</form>
    </div>
    
</body>
<?php include 'footer.php'; ?>
</html>