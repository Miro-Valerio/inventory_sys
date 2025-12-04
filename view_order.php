<?php
include 'database.php';

// Fetch orders with customer names
$orders = $conn->query("
    SELECT o.*, c.FullName 
    FROM orders o 
    LEFT JOIN customers c ON o.CustomerID = c.CustomerID
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
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
   

</header>

<div class="container">
    <h1>Orders</h1>
    <table>
        <tr>
            <th>OrderID</th>
            <th>Customer</th>
            <th>OrderDate</th>
            <th>Actions</th>
        </tr>
        <?php while($ord = $orders->fetch_assoc()): ?>
        <tr>
            <td><?php echo $ord['OrderID']; ?></td>
            <td><?php echo $ord['FullName']; ?></td>
            <td><?php echo $ord['OrderDate']; ?></td>
            <td>
    <div class="action-buttons">
        <a href="orderdetails.php?id=<?php echo $ord['OrderID']; ?>">
            <button class="btn-main">View Details</button>
        </a>
        <a href="create_order.php?customerID=<?php echo $ord['CustomerID']; ?>">
            <button class="btn-main">Create Order</button>
        </a>
    </div>
</td>

        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
