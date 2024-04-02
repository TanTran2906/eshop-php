<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white py-3 fixed-top">
        <div class="container">
            <img class="logo" src="./assets/img/logo.png" />
            <h2 class="brand">Sun</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact us</a>
                    </li>

                    <li class="nav-item">
                        <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
                        <a href="account.php"><i class="fa-solid fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home  -->
    <section id="home">
        <div class="container">
            <h4>NEW ARRIVALS</h4>
            <h1><span>Best Prices</span> This Season</h1>
            <p>
                Eshop offers the best products for the most affordable
                prices
            </p>
            <button>Shop Now</button>
        </div>
    </section>

    <!-- Brands  -->
    <section id="brand" class="container">
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand1.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand2.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand3.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand4.jpg" />
        </div>
    </section>

    <!-- New products -->
    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <!-- One  -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/img/1.jpg" />
                <div class="details">
                    <h2>Extreamely Shoes</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>

            <!-- Two  -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/img/2.jpg" />
                <div class="details">
                    <h2>Awesome Jackets</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>

            <!-- Three  -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/img/3.jpg" />
                <div class="details">
                    <h2>50% Off Watches</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured - Product  -->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Featured</h3>
            <hr />
            <p>Here you can check out our featured products</p>
        </div>
        <div class="row mx-auto container-fluid">
            <!-- Product 1 -->
            <?php include ("server/get_featured_products.php") ?>

            <?php while ($row = $featured_products->fetch_assoc()) { ?>

                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/img/<?php echo $row['product_image']; ?>" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">
                        <?php echo $row['product_name']; ?>
                    </h5>
                    <h4 class="p-price">$
                        <?php echo $row['product_price']; ?>
                    </h4>
                    <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Buy
                            Now</button></a>
                </div>
            <?php } ?>

        </div>
    </section>

    <!-- Banner  -->
    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>MID SEASON'S SALE</h4>
            <h1>
                Autumn Collection <br />
                UP to 30% OFF
            </h1>
            <button class="text-uppercase">shop now</button>
        </div>
    </section>

    <!-- Product: DELL  -->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>DELL</h3>
            <hr class="mx-auto" />
            <p>Here you can check out our amazing laptop</p>
        </div>
        <div class="row mx-auto container-fluid">
            <!-- Product 1 -->
            <?php include ("server/get_DELL.php") ?>

            <?php while ($row = $DELL_products->fetch_assoc()) { ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/img/<?php echo $row['product_image']; ?>" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">
                        <?php echo $row['product_name']; ?>
                    </h5>
                    <h4 class="p-price">$
                        <?php echo $row['product_price']; ?>
                    </h4>
                    <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Buy
                            Now</button></a>
                </div>

            <?php } ?>

        </div>
    </section>

    <!-- Product: ACER  -->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>ACER</h3>
            <hr class="mx-auto" />
            <p>Here you can check out our amazing laptop</p>
        </div>
        <div class="row mx-auto container-fluid">
            <!-- Product 1 -->
            <?php include ("server/get_ACER.php") ?>

            <?php while ($row = $ACER_products->fetch_assoc()) { ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/img/<?php echo $row['product_image']; ?>" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">
                        <?php echo $row['product_name']; ?>
                    </h5>
                    <h4 class="p-price">$
                        <?php echo $row['product_price']; ?>
                    </h4>
                    <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Buy
                            Now</button></a>
                </div>

            <?php } ?>

        </div>
    </section>

    <!-- Product: HP  -->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>HP</h3>
            <hr class="mx-auto" />
            <p>Here you can check out our amazing laptop</p>
        </div>
        <div class="row mx-auto container-fluid">
            <!-- Product 1 -->
            <?php include ("server/get_HP.php") ?>

            <?php while ($row = $HP_products->fetch_assoc()) { ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/img/<?php echo $row['product_image']; ?>" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">
                        <?php echo $row['product_name']; ?>
                    </h5>
                    <h4 class="p-price">$
                        <?php echo $row['product_price']; ?>
                    </h4>
                    <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Buy
                            Now</button></a>
                </div>

            <?php } ?>

        </div>
    </section>

    <?php include ("layouts/footer.php") ?>
</body>

</html>