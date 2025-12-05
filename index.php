<?php include "database.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Shoe Inventory</title>
    <link rel="stylesheet" href="style.css">
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

<section>
<h1>Product List</h1>

<section class="product-wrapper">

    <a class="add-btn" href="add_product.php">Add Product</a>

    <div class="product-container">
    <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $image = (!empty($row['ImagePath'])) ? $row['ImagePath'] : 'nike.png';

                echo "
<div class='product-card'>
    <p class='brand'>Brand: {$row['Brand']}</p>
    <h2 class='product-name'>{$row['ProductName']}</h2>
    <div class='product-image'>
        <img src='$image' alt='shoe'>
    </div>
    <p>Size: {$row['Size']}</p>
    <p>Price: {$row['Price']}</p>
    <p>Stock: {$row['Stock']}</p>
    <div class='card-buttons'>
        <a class='buy-btn' href='create_order.php?productID={$row['ProductID']}'>Buy</a>
        <a class='edit-btn' href='edit_product.php?id={$row['ProductID']}'>Edit</a>
        <a class='delete-btn' href='delete_product.php?id={$row['ProductID']}'>Delete</a>
    </div>
</div>
";
            }
        } else {
            echo "<p>No products found.</p>";
        }
    ?>
    </div>

</section>
</section>

</body>
</html>
