<?php 
include "db.php";
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['add'])) {
    $name=$_POST['name'] ?? null;
    $desc=$_POST['description']?? null;
    $price=$_POST['price']?? null;
    $image=$_POST['image']?? null;;
    $category=$_POST['category']?? null;
    }
    if ($name && $desc && $price && $image && $category)
      {$query1=$conn->prepare("insert into coffees(name,description,price,image,category) values (?,?,?,?,?)");
       $query1->bind_param('ssdss',$name,$desc,$price,$image,$category);
       $query1->execute();
       $query1->close();
      }else{echo "please fill out all fields.";}

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
    </style>
</head>
<body>

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