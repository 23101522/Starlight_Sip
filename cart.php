<?php require_once 'init.php'; ?>

<?php
include 'db.php';

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $coffee_id = $_POST['coffee_id'];
    $quantity = $_POST['quantity'] ?? 1;
    
    $stmt = $conn->prepare("SELECT * FROM coffees WHERE id = ?");
    $stmt->bind_param("i", $coffee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $coffee = $result->fetch_assoc();
    
    if ($coffee) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $coffee_id) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $coffee_id,
                'name' => $coffee['name'],
                'price' => $coffee['price'],
                'quantity' => $quantity,
                'image' => $coffee['image']
            ];
        }
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    header("Location: cart_view.php");
    exit();
}

// Update cart quantities
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $quantity) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] = max(1, (int)$quantity);
                break;
            }
        }
    }
    header("Location: menu.php");
    exit();
}

// Cancel/empty the cart
if (isset($_GET['cancel'])) {
    unset($_SESSION['cart']);
    header("Location: menu.php");
    exit();
}
?>