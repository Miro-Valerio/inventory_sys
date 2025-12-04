<?php
include 'database.php';
$customers = $conn->query("SELECT * FROM customers");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <link rel="stylesheet" href="all.css">
</head>
 <style>
        /* Form styles */
        .container {
            max-width: 695px;
            margin: 30px auto;
            background-color: #111322;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.4);
        }

    </style>
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
    <h1>Customers</h1>
    <a href="add_customer.php"><button class="btn-main">Add Customer</button></a>
    <table>
        <tr>
            <th>CustomerID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php while($cust = $customers->fetch_assoc()): ?>
        <tr>
            <td><?php echo $cust['CustomerID']; ?></td>
            <td><?php echo $cust['FullName']; ?></td>
            <td><?php echo $cust['Email']; ?></td>
            <td><?php echo $cust['Phone']; ?></td>
            <td>
                <div class="action-buttons">
                    <a href="edit_customer.php?id=<?php echo $cust['CustomerID']; ?>">
                        <button class="btn-main">Edit</button>
                    </a>
                    <a href="delete_customer.php?id=<?php echo $cust['CustomerID']; ?>" 
                       onclick="return confirm('Delete this customer?')">
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
