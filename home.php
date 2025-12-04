<!DOCTYPE html>
<html>
<head>
    <title>Shoe Inventory</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
  <header>
    <div class="logo">JUMPSHOT</div>
    <ul class="nav">
    <li><a href="home.php" class="<?= basename($_SERVER['PHP_SELF'])=='home.php'?'active':'' ?>">Home</a></li>
    <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF'])=='index.php'?'active':'' ?>">Products</a></li>
    <li><a href="manage_category.php" class="<?= basename($_SERVER['PHP_SELF'])=='manage_category.php'?'active':'' ?>">Categories</a></li>
    <li><a href="manage_customer.php" class="<?= basename($_SERVER['PHP_SELF'])=='manage_customer.php'?'active':'' ?>">Customers</a></li>
    <li><a href="view_order.php" class="<?= basename($_SERVER['PHP_SELF'])=='view_order.php'?'active':'' ?>">Orders</a></li>
</ul>

</header>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text">
        <h4>JUMPSHOT</h4>
        <h2>STEP UP YOUR GAME<br><span>JUMPSHOT</span><br>IS ON THE WAY.</h2>
        <p>Discover the best basketball shoes with premium quality and stunning design.</p>
    </div>

    <div class="hero-img">
        <img src="nike.png" alt="hero-shoe">
    </div>
</section>
<h2 class="section-title">Collections</h2>
<section class="collection">

    <div class="big-box">
        <h3>UNDER ARMOUR</h3>
        <p>UP TO <span>55% OFF</span></p>
        <img src="img/under.png">
    </div>

    <div class="small-box1">
        <h3>ADIDAS SHOES</h3>
        <img src="img/adidas.png">
    </div>

    <div class="small-box">
        <h3>NIKE SHOES</h3>
        <img src="img/nike.png">
    </div>

</section>

<section class="mens">

    <div class="card">
        <img src="img/intro shoes.png">
        <h4>Under Armour Curry 11</h4>
    </div>

    <div class="card">
        <img src="img/2.png">
        <h4>ADIDAS RUNNER</h4>
    </div>

    <div class="card">
        <img src="img/3.png">
        <h4>Lebron 20</h4>

    </div>

    <div class="card">
        <img src="img/5.png">
        <h4>Lebron 22</h4>
    </div>

</section>

<!-- ABOUT US -->
<section class="about">
    <div class="about-text">
        <h3>ELEVATE YOUR<br>LOOK WITH SHOES</h3>
        <p>
            We offer premium quality shoes at affordable prices.
            Shop confidently and enjoy stylish sneakers suited for any outfit.
        </p>
    </div>

    <img src="img/under.png" class="about-img">
</section>

</body>
</html>

