<?php
include 'database.php';

$order_id = $_GET['id'] ?? 0; // avoid undefined index

// Fetch order with customer info
$order = $conn->query("
    SELECT o.*, c.FullName 
    FROM orders o 
    LEFT JOIN customers c ON o.CustomerID = c.CustomerID 
    WHERE o.OrderID = '$order_id'
")->fetch_assoc();

// Fetch order items with product info
$items = $conn->query("
    SELECT oi.*, p.ProductName 
    FROM order_items oi 
    LEFT JOIN products p ON oi.ProductID = p.ProductID 
    WHERE oi.OrderID = '$order_id'
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
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
    <h1>Order #<?php echo $order['OrderID']; ?> Details</h1>
    <p><strong>Customer:</strong> <?php echo $order['FullName']; ?></p>
    <p><strong>Date:</strong> <?php echo $order['OrderDate']; ?></p>

    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        <?php 
        $total = 0;
        while($item = $items->fetch_assoc()):
            $subtotal = $item['Quantity'] * $item['Price'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?php echo $item['ProductName']; ?></td>
            <td><?php echo $item['Quantity']; ?></td>
            <td><?php echo number_format($item['Price'], 2); ?></td>
            <td><?php echo number_format($subtotal, 2); ?></td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <th colspan="3">Total</th>
            <th><?php echo number_format($total, 2); ?></th>
        </tr>
    </table>
</div>
</body>
</html>
