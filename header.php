<?php 
// header.php - First line should be:
require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
...
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
    <header style="background:transparent; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <a href="menu.php" style="text-decoration: none;">
        <h1 style="color: sandybrown; margin: 0;">Starlight Sip</h1>
    </a>
    <?php if(isset($_SESSION['email'])): ?>
        <nav>
            <a href="menu.php" style="color:white; margin-right: 15px; text-decoration: none; font-size: medium;">Menu</a>
            <a href="logout.php" style="color: white; text-decoration: none;">Logout</a>
        </nav>
    <?php endif; ?>
</header>
    <main>