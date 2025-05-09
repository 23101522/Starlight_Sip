<?php require_once 'init.php'; ?>

<?php
include 'db.php';

if (!isset($_GET['order_id'])) {
    header("Location: menu.php");
    exit();
}

$order_id = $_GET['order_id'];
$email = $_SESSION['email'] ?? '';

// Get order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_email = ?");
$stmt->bind_param("is", $order_id, $email);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    header("Location: menu.php");
    exit();
}

// Get order items
$stmt = $conn->prepare("SELECT oi.*, c.name FROM order_items oi 
                       JOIN coffees c ON oi.coffee_id = c.id 
                       WHERE oi.order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body { font-family: Arial; background: #fdf6ec; padding: 20px; }
        .confirmation-container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }
        .success-icon { color: #6F4E37; font-size: 50px; margin-bottom: 20px; }
        .order-details { margin: 20px 0; text-align: left; }
        .order-item { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; }
        .order-total { font-weight: bold; font-size: 1.2em; text-align: right; margin-top: 10px; }
        .back-btn { background: #6F4E37; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; text-decoration: none; display: inline-block; margin-top: 20px; }
        .back-btn:hover { background: #5a3e2b; }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div class="success-icon">✓</div>
        <h1>Payment Successful!</h1>
        <p>Thank you for your order. Your payment has been processed successfully.</p>
        
        <div class="order-details">
            <h2>Order #<?= $order_id ?></h2>
            <p>Date: <?= date('F j, Y, g:i a', strtotime($order['created_at'])) ?></p>
            
            <h3>Items Ordered:</h3>
            <?php while ($item = $items->fetch_assoc()): ?>
                <div class="order-item">
                    <span><?= htmlspecialchars($item['name']) ?> (×<?= $item['quantity'] ?>)</span>
                    <span><?= number_format($item['price'] * $item['quantity'], 2) ?> TK</span>
                </div>
            <?php endwhile; ?>
            <div class="order-total">
                Total: <?= number_format($order['total_amount'], 2) ?> TK
            </div>
        </div>
        
        <a href="menu.php" class="back-btn">Back to Menu</a>
    </div>
</body>
</html>