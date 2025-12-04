<?php include "database.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="add_product.css"> 
</head>
<body>

<form method="POST" enctype="multipart/form-data">
    <h2 class="form-title">Add Product</h2>

    <label>Product Name:</label>
    <input type="text" name="ProductName" required>

    <label>Brand:</label>
    <input type="text" name="Brand">

    <label>Size:</label>
    <input type="text" name="Size">

    <label>Price:</label>
    <input type="number" step="0.01" name="Price">

    <label>Stock:</label>
    <input type="number" name="Stock">

    <label>Category:</label>
    <select name="CategoryID">
        <?php
        $cat = $conn->query("SELECT * FROM categories");
        while ($c = $cat->fetch_assoc()) {
            echo "<option value='{$c['CategoryID']}'>{$c['CategoryName']}</option>";
        }
        ?>
    </select>

    <label>Product Image:</label>
    <input type="file" name="image" required>

    <button type="submit" name="submit">Add Product</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['ProductName'];
    $brand = $_POST['Brand'];
    $size = $_POST['Size'];
    $price = $_POST['Price'];
    $stock = $_POST['Stock'];
    $category = $_POST['CategoryID'];

    // ---------------- IMAGE UPLOAD FIXED ---------------------
    $imageName = $_FILES["image"]["name"];
    $imageTmp = $_FILES["image"]["tmp_name"];

    if (!empty($imageName)) {

        if (!is_dir("product_images")) {
            mkdir("product_images", 0777, true);
        }

        // unique file name
        $newImageName = time() . "_" . basename($imageName);

        $imagePath = "product_images/" . $newImageName;

        if (!move_uploaded_file($imageTmp, $imagePath)) {
            echo "<script>alert('Image upload failed!');</script>";
        }

    } else {
        $imagePath = "";
    }
    // ----------------------------------------------------------

    // insert product
    $sql = "INSERT INTO products (ProductName, Brand, Size, Price, Stock, CategoryID, ImagePath)
            VALUES ('$name', '$brand', '$size', '$price', '$stock', '$category', '$imagePath')";

    if ($conn->query($sql)) {
        echo "<script>alert('Product Added!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

</body>
</html>
