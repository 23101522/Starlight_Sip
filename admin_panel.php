<?php require_once 'init.php'; ?>
<?php 
include "db.php";
$name = $desc = $price = $image = $category = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'] ?? '';
    $desc = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? '';
    $category = $_POST['category'] ?? '';
    
    if ($name && $desc && $price && $image && $category) {
        $query1 = $conn->prepare("INSERT INTO coffees(name,description,price,image,category) VALUES (?,?,?,?,?)");
        $query1->bind_param('ssdss', $name, $desc, $price, $image, $category);
        $query1->execute();
        $query1->close();
    } else {
        $error = "Please fill out all fields.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query2 = $conn->prepare("DELETE FROM coffees WHERE id = ?");
    $query2->bind_param("i", $id);
    $query2->execute();
    $query2->close();
}
$result= $conn->query("select * from coffees");?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Coffee Menu</title>
    <style>
        body { font-family: Arial; background: #fdf7f0; padding: 20px; }
        h2 { color: #5a3e2b; }
        form { margin-bottom: 30px; }
        input, textarea { padding: 8px; width: 100%; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        .delete-btn { background: #e57373; color: white; border: none; padding: 6px 10px; cursor: pointer; }
        .submit-btn { background: #81c784; color: white; border: none; padding: 10px 20px; cursor: pointer; }
        /* Admin Header Styles */
.admin-header {
    display: flex;
    justify-content: flex-end; /* Align items to the right */
    padding: 15px 20px;
    background: transparent; /* Or your preferred background */
    margin-bottom: 20px;
}

.admin-actions {
    display: flex;
    align-items: center;
    gap: 15px; /* Space between buttons */
}

.admin-actions a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 16px;
    transition: all 0.3s ease;
}

/* View Orders Button */
.admin-actions a[href="admin_orders.php"] {
    color: #5a3e2b;
    background: rgba(138, 154, 91, 0.2); /* Light background */
    border: 1px solid rgba(90, 62, 43, 0.2);
}

.admin-actions a[href="admin_orders.php"]:hover {
    background: rgba(138, 154, 91, 0.3);
    transform: translateY(-1px);
}

/* Logout Button */
.admin-actions a[href="Admin_logout.php"] {
    color: #5a3e2b;
    background: rgba(231, 76, 60, 0.2); /* Light red background */
    border: 1px solid rgba(231, 76, 60, 0.2);
}

.admin-actions a[href="Admin_logout.php"]:hover {
    background: rgba(231, 76, 60, 0.3);
    transform: translateY(-1px);
}

/* Icons */
.admin-actions i {
    font-size: 0.9em;
}
        
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 15px;
            background:lightcoral;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
        }
        
        .logout-btn i {
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<div class="admin-header">
    <div class="admin-actions">
        <a href="admin_orders.php" class="btn" style="background:tranparent; font-size: medium;">
            <i class="fas fa-clipboard-list"></i> View Orders
        </a>
        <a href="admin_logout.php" class="logout-btn" style="background:tranparent; font-size: medium; color: #5a3e2b;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>
<h2>☕ Add New Coffee</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br><br>
    <textarea name="description" placeholder="Description" required></textarea><br><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>
    <input type="text" name="image" placeholder="Image path (e.g., images/latte.jpg)" required><br><br>
    <input type="text" name="category" placeholder="Category (Hot/Cold)" required><br><br>
    <input type="submit" name="add" value="Add Item" class="submit-btn">
</form>

<h2>📋 Coffee Menu</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Category</th><th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>$<?= number_format($row['price'], 2) ?></td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                    <input type="submit" name="delete" value="Delete" class="delete-btn">
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

<?php $conn->close(); ?>