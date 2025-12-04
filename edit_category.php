<?php
include 'database.php';
$id = $_GET['id'];

$category = $conn->query("SELECT * FROM categories WHERE CategoryID='$id'")->fetch_assoc();

if(isset($_POST['submit'])){
    $name = $_POST['CategoryName'];

    $stmt = $conn->prepare("UPDATE categories SET CategoryName=? WHERE CategoryID=?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_category.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
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
    <h1>Edit Category</h1>
    <form method="post">
        <label>Category Name:</label>
        <input type="text" name="CategoryName" value="<?php echo $category['CategoryName']; ?>" required>
        <input type="submit" name="submit" value="Update Category">
    </form>
</div>
</body>
</html>