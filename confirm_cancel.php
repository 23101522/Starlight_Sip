<?php require_once 'init.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Cancellation</title>
    <style>
        body { font-family: Arial; background: #fdf6ec; padding: 20px; text-align: center; }
        .confirmation-box { 
            background: white; 
            max-width: 400px; 
            margin: 50px auto; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .buttons { margin-top: 20px; }
        .btn { 
            padding: 10px 20px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }
        .confirm-btn { background: #e74c3c; color: white; }
        .confirm-btn:hover { background: #c0392b; }
        .cancel-btn { background: #666; color: white; border: none; max-width: 120px; }
        .cancel-btn:hover { background: #555; transform: scale(0.98); }
    </style>
</head>
<body>
    <div class="confirmation-box">
        <h2>Confirm Cancellation</h2>
        <p>Are you sure you want to cancel your order and empty your cart?</p>
        
        <div class="buttons">
            <a href="cart.php?cancel=1" class="btn confirm-btn">Yes, Cancel Order</a>
            <a href="cart_view.php" class="btn cancel-btn">No, Keep Items</a>
        </div>
    </div>
</body>
</html>