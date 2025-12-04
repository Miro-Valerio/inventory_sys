<?php
include 'database.php';

if(isset($_POST['submit'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO customers (FullName, Email, Phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $phone);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_customer.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
    <link rel="stylesheet" href="all.css">
    <style>
        /* Form styles */
        .container {
            max-width: 500px;
            margin: 30px auto;
            background-color: #111322;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.4);
        }
        h1 {
            color: #28e0b9;
            text-align: center;
            margin-bottom: 25px;
        }
        label {
            font-weight: bold;
            color: #28e0b9;
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="email"], input[type="tel"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #444;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #28e0b9;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background: transparent;
            color: #28e0b9;
            border: 2px solid #28e0b9;
        }
    </style>
</head>
<body>


<div class="container">
    <h1>Add Customer</h1>
    <form method="post">
        <label>Full Name:</label>
        <input type="text" name="fullname" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Phone:</label>
        <input type="tel" name="phone" required>

        <input type="submit" name="submit" value="Add Customer">
    </form>
</div>
</body>
</html>
