<?php
include 'database.php';

if(isset($_POST['submit'])){
    $name = $_POST['CategoryName'];
    $stmt = $conn->prepare("INSERT INTO categories (CategoryName) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_category.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
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

<div class="container">
    <h1>Add Category</h1>
    <form method="post">
        <label>Category Name:</label>
        <input type="text" name="CategoryName" required>
        <input type="submit" name="submit" value="Add Category">
    </form>
</div>
</body>
</html>