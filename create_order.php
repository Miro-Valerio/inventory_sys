<?php
include 'database.php';

// Fetch customers and products
$customers = $conn->query("SELECT * FROM customers");
$products = $conn->query("SELECT * FROM products");

if (isset($_POST['submit'])) {

    $customer_id = $_POST['customer_id'];
    $date = date('Y-m-d H:i:s');

    // INSERT ORDER
    $conn->query("INSERT INTO orders (CustomerID, OrderDate) VALUES ('$customer_id', '$date')");
    $order_id = $conn->insert_id;

    // INSERT ORDER ITEMS
    foreach ($_POST['product'] as $item) {

        if (isset($item['check'])) {

            $product_id = $item['id'];
            $quantity   = $item['quantity'];

            if ($quantity <= 0) continue;

            $product = $conn->query("
                SELECT Price, Stock FROM products 
                WHERE ProductID = '$product_id'
            ")->fetch_assoc();

            if ($quantity > $product['Stock']) continue;

            $price = $product['Price'];
            $total = $quantity * $price;

            $conn->query("
                INSERT INTO order_items (OrderID, ProductID, Quantity, Price, Total)
                VALUES ('$order_id', '$product_id', '$quantity', '$price', '$total')
            ");

            $conn->query("
                UPDATE products SET Stock = Stock - $quantity 
                WHERE ProductID = '$product_id'
            ");
        }
    }

    header("Location: view_order.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Order</title>
<style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #0d0d17;
    color: #fff;
    margin: 0;
    padding: 0;
}
header {
    position: sticky;  
    top: 0;           
    z-index: 1000;     
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 60px;
    background: #0b0b12;
}


.logo {
    font-size: 24px;
    font-weight: bold;
    color: #28e0b9;
}

.nav {
    list-style: none;
    display: flex;
    gap: 40px;
    justify-content: right;

}

.nav li {
    display: flex;
}

.nav a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    transition: 0.3s;
}

.nav a:hover {
    color: #28e0b9;
}

.nav a.active {
    color: #28e0b9;
}


   /* Main container */
.container {
    max-width: 600px;
    margin: 30px auto;
    background-color: #111322;
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.4);
}

/* Title */
.container h1 {
    color: #28e0b9;
    text-align: center;
    margin-bottom: 25px;
}

/* Labels */
label, h3 {
    font-weight: bold;
    color: #28e0b9;
    margin-bottom: 10px;
}

/* Select box */
select {
    width: 100%;
    padding: 10px;
    background: #0e1020;
    color: #fff;
    border-radius: 8px;
    border: 1px solid #2a2c3e;
    margin-bottom: 20px;
}

/* Product rows */
.product-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #1a1c2c;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 12px;
    color: #fff;
}

/* Checkbox */
.product-row input[type="checkbox"] {
    transform: scale(1.3);
}

/* Quantity box */
.product-row input[type="number"] {
    width: 70px;
    padding: 8px;
    border-radius: 6px;
    background: #0e0f1a;
    border: 1px solid #333;
    color: #fff;
}

/* Submit button */
input[type="submit"] {
    width: 100%;
    padding: 12px;
    background: #28e0b9;
    color: #000;
    font-weight: bold;
    border-radius: 8px;
    border: none;
    margin-top: 20px;
    cursor: pointer;
    transition: 0.3s;
}

input[type="submit"]:hover {
    background: transparent;
    border: 2px solid #28e0b9;
    color: #28e0b9;
}
</style>

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
    <li><a href="create_order.php" class="<?= basename($_SERVER['PHP_SELF'])=='create_order.php'?'active':'' ?>">Create Orders</a></li>
</ul>

</header>
<div class="container">
    <h1>Create Order</h1>

    <form method="post">
        <label>Customer:</label>
        <br>
        <select name="customer_id" required>
            <?php while ($cust = $customers->fetch_assoc()): ?>
                <option value="<?= $cust['CustomerID'] ?>">
                    <?= $cust['FullName'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <h3>Products:</h3>

        <?php while ($prod = $products->fetch_assoc()): ?>
            <div class="product-row">

                <input type="checkbox" name="product[<?= $prod['ProductID'] ?>][check]">

                <span>
                    <strong><?= $prod['ProductName'] ?></strong><br>
                    Price: <?= $prod['Price'] ?> | Stock: <?= $prod['Stock'] ?>
                </span>

                <input type="hidden" name="product[<?= $prod['ProductID'] ?>][id]" value="<?= $prod['ProductID'] ?>">

                <input type="number" 
                       name="product[<?= $prod['ProductID'] ?>][quantity]" 
                       value="0" 
                       min="0">
            </div>
        <?php endwhile; ?>

        <input type="submit" name="submit" value="Create Order">
    </form>

</div>

</body>
</html>
