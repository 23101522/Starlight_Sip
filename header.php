<?php 
require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Starlight Sip'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="main-header">
        <a href="menu.php" class="logo">
            <h1>Starlight Sip</h1>
        </a>
        <?php if(isset($_SESSION['email'])): ?>
            <nav class="main-nav">
                <a href="cart_view.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                <a href="review.php"><i class="fas fa-star"></i> Reviews</a>
                <a href="reservation.php"><i class="fas fa-calendar-alt"></i> Reservations</a>
                <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        <?php endif; ?>
    </header>
    <main>