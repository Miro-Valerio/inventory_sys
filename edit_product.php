<?php 
include "database.php";

$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE ProductID=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="edit_product.css">
</head>
<body>

<h1 class="page-title">Edit Product</h1>

<form method="POST" enctype="multipart/form-data">

    <label>Product Name:</label>
    <input type="text" name="ProductName" value="<?= $product['ProductName'] ?>" required>

    <label>Brand:</label>
    <input type="text" name="Brand" value="<?= $product['Brand'] ?>">

    <label>Size:</label>
    <input type="text" name="Size" value="<?= $product['Size'] ?>">

    <label>Price:</label>
    <input type="number" step="0.01" name="Price" value="<?= $product['Price'] ?>">

    <label>Stock:</label>
    <input type="number" name="Stock" value="<?= $product['Stock'] ?>">

    <label>Category:</label>
    <select name="CategoryID">
        <?php
        $cat = $conn->query("SELECT * FROM categories");
        while ($c = $cat->fetch_assoc()) {
            $sel = ($c['CategoryID'] == $product['CategoryID']) ? "selected" : "";
            echo "<option value='{$c['CategoryID']}' $sel>{$c['CategoryName']}</option>";
        }
        ?>
    </select>

    <!-- IMAGE PREVIEW -->
    <label>Current Image:</label>
    <div style="margin-bottom:15px;">
        <img src="<?= $product['ImagePath'] ?>" width="150" style="border-radius:8px;">
    </div>

    <!-- NEW IMAGE UPLOAD -->
    <label>Upload New Image (optional):</label>
    <input type="file" name="image">

    <button type="submit" name="update">Update Product</button>
</form>

<?php
if (isset($_POST['update'])) {

    // default old image
    $imagePath = $product['ImagePath'];

    // If new image uploaded
    if (!empty($_FILES["image"]["name"])) {

        $imageName = $_FILES["image"]["name"];
        $imageTmp = $_FILES["image"]["tmp_name"];

        if (!is_dir("product_images")) {
            mkdir("product_images", 0777, true);
        }

        $newImageName = time() . "_" . basename($imageName);
        $imagePath = "product_images/" . $newImageName;

        move_uploaded_file($imageTmp, $imagePath);
    }

    // UPDATE QUERY
    $sql = "
    UPDATE products SET 
        ProductName='{$_POST['ProductName']}',
        Brand='{$_POST['Brand']}',
        Size='{$_POST['Size']}',
        Price='{$_POST['Price']}',
        Stock='{$_POST['Stock']}',
        CategoryID='{$_POST['CategoryID']}',
        ImagePath='$imagePath'
    WHERE ProductID=$id";

    if ($conn->query($sql)) {
        echo "<script>alert('Product Updated!'); window.location='index.php';</script>";
    }
}
?>
</body>
</html>
