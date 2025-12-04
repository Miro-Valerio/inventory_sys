<?php
include 'database.php';
$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
    <link rel="stylesheet" href="all.css">
</head>
<body>
  <header>
    <div class="logo">JUMPSHOT</div>
    <ul class="nav">
    <li><a href="home.php" class="<?= basename($_SERVER['PHP_SELF'])=='home.php'?'active':'' ?>">Home</a></li>
    <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF'])=='index.php'?'active':'' ?>">Products</a></li>
    <li><a href="manage_category.php" class="<?= basename($_SERVER['PHP_SELF'])=='manage_category.php'?'active':'' ?>">Categories</a></li>
    <li><a href="manage_customer.php" class="<?= basename($_SERVER['PHP_SELF'])=='manage_customer.php'?'active':'' ?>">Customers</a></li>
    <li><a href="view_order.php" class="<?= basename($_SERVER['PHP_SELF'])=='create_order.php'?'active':'' ?>">Orders</a></li>
   
</ul>

</header>

</header>
<div class="container">
    <h1>Categories</h1>
    <a href="add_category.php"><button>Add Category</button></a>
    <table>
        <tr><th>ID</th><th>Name</th><th>Actions</th></tr>
        <?php while($cat = $categories->fetch_assoc()): ?>
        <tr>
            <td><?php echo $cat['CategoryID']; ?></td>
            <td><?php echo $cat['CategoryName']; ?></td>
            <td>
 
    <div class="action-buttons">
        <a href="edit_category.php?id=<?= $cat['CategoryID'] ?>">
            <button class="btn-main">Edit</button>
        </a>

        <a href="delete_category.php?id=<?= $cat['CategoryID'] ?>"
           onclick="return confirm('Delete this category?')">
            <button class="btn-main">Delete</button>
        </a>
    </div>

</td>

        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>