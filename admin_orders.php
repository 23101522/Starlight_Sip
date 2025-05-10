<?php
require_once 'init.php';

// Verify admin login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

// Fetch all orders
$orders_query = "SELECT o.id, o.user_email, o.total_amount, o.created_at, 
                COUNT(oi.id) as item_count 
                FROM orders o
                LEFT JOIN order_items oi ON o.id = oi.order_id
                GROUP BY o.id
                ORDER BY o.created_at DESC";
$orders_result = $conn->query($orders_query);

// Calculate totals
$totals_query = "SELECT 
                COUNT(id) as total_orders,
                SUM(total_amount) as total_revenue
                FROM orders";
$totals_result = $conn->query($totals_query);
$totals = $totals_result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: Arial; background: #f8f9fa; padding: 20px; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .summary-cards { display: flex; gap: 20px; margin-bottom: 30px; }
        .summary-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex: 1; }
        .summary-card h3 { margin-top: 0; color: #6F4E37; }
        .summary-card .value { font-size: 24px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #6F4E37; color: white; }
        tr:hover { background: #f5f5f5; }
        .badge { background: #e0c097; color: #5a3e2b; padding: 3px 8px; border-radius: 10px; font-size: 12px; }
    
        /* Admin Header Styles */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

.admin-nav-btn {
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

.admin-nav-btn:hover {
            background-color:rgb(252, 249, 247);
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.admin-nav-btn i {
    margin-right: 5px;
}

    
    </style>
</head>
<body>
<div class="admin-header">
    <h1><i class="fas fa-clipboard-list"></i> Order Dashboard</h1>
    <a href="admin_panel.php" class="admin-nav-btn" style="color: black;">
    <i class="fas fa-arrow-left"></i> Back to Menu
</a>
</div>

    <div class="summary-cards">
        <div class="summary-card">
            <h3>Total Orders</h3>
            <div class="value"><?= $totals['total_orders'] ?></div>
        </div>
        <div class="summary-card">
            <h3>Total Revenue</h3>
            <div class="value"><?= number_format($totals['total_revenue'], 2) ?> TK</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Email</th>
                <th>Items</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while($order = $orders_result->fetch_assoc()): ?>
            <tr>
                <td>#<?= $order['id'] ?></td>
                <td><?= htmlspecialchars($order['user_email']) ?></td>
                <td><span class="badge"><?= $order['item_count'] ?> items</span></td>
                <td><?= number_format($order['total_amount'], 2) ?> TK</td>
                <td><?= date('M j, Y g:i A', strtotime($order['created_at'])) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>