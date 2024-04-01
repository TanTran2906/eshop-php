<?php
include ('server/connection.php');


if (isset($_GET['product_id'])) {
    //Get id from URL
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result();//[]

}

//no product id was given
else {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Single product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/single_product.css" />
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

    <!-- Product  -->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">
            <?php while ($row = $product->fetch_assoc()) { ?>

                <div class="col-lg-5 col-md-6 col-sm-12">
                    <img class="img-fluid w-100 pb-1" src="assets/img/<?php echo $row['product_image']; ?>" />
                    <!-- Các hình ảnh nhỏ liên quan đến sản phẩm -->
                    <!-- <div class="small-img-group">
                        <div class="small-img-col">
                            <img
                                src="assets/img/featured2.jpg"
                                width="100%"
                                class="small-img"
                            />
                        </div>
                    </div> -->
                </div>

                <div class="col-lg-6 col-md-12 col-12">
                    <h6 class="pt-4">LAPTOP</h6>
                    <h3 class="py-4">
                        <?php echo $row['product_name']; ?>
                    </h3>
                    <h2>
                        <?php echo $row['product_price']; ?>$
                    </h2>

                    <!-- Form to add to cart  -->
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
                        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
                        <input type="number" name="product_quantity" value="1" />
                        <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
                    </form>

                    <h4 class="mt-5 mb-5">Product details</h4>
                    <span>
                        <?php echo $row['product_description']; ?>
                    </span>
                </div>

            <?php } ?>
        </div>
    </section>

    <!-- Related products -->
    <section id="related-products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related products</h3>
            <hr />
        </div>
        <div class="row mx-auto container-fluid">
            <!-- Product 1 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/img/featured1.jpg" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <!-- Product 2-->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/img/featured2.jpg" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <!-- Product 3 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/img/featured3.jpg" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <!-- Product 4 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/img/featured4.jpg" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>

    <!--Footer -->
    <?php include ("layouts/footer.php") ?>
</body>

</html>