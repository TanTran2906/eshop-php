<?php
include ('server/connection.php');

$stmt = $conn->prepare("SELECT * FROM products");

$stmt->execute();

$products = $stmt->get_result();//[]



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/shop.css" />
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
                        <a class="nav-link" href="shop.html">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact us</a>
                    </li>

                    <li class="nav-item">
                        <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
                        <a href="account.html"><i class="fa-solid fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar - Tìm kiếm, lọc -->
    <!-- <section id="search" class="my-5 py-5 ms-2">
        <div class="container mt-5 py-5">
            <p>Search Products</p>
            <hr class="line">
        </div>

        <form>
            <div class="row mx-auto container">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Category</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="category_one">
                        <label class="form-check-label" for="flexRadioDefault1">
                            ASUS
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="category_two" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            DELL
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="category_two" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            ACER
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="category_two" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            HP
                        </label>
                    </div>

                </div>
            </div>

            <div class="row mx-auto container mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <p>Price</p>
                    <input type="range" class="form-range w-50" min="1" max="1000" id="customRange2">
                    <div class="w-50">
                        <span style="float: left;">1</span>
                        <span style="float:right;">1000</span>
                    </div>
                </div>
            </div>

            <div class="form-group my-3 mx-3">
                <input type="submit" name="search" value="Search" class="btn btn-primary">
            </div>

        </form>
    </section> -->


    <!-- Shop -->
    <section id="featured" class="my-5 py-5">
        <div class="container mt-5 py-5">
            <h3>Our Products</h3>
            <hr class="line" />
            <p>Here you can check out our products</p>
        </div>

        <div class="row mx-auto container-fluid">
            <?php while ($row = $products->fetch_assoc()) { ?>
                <!-- Product 1 -->
                <div onclick="window.location.href='single_product.php'"
                    class="product text-center col-lg-3 col-md-4 col-sm-12">
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
                    <a class="btn buy-btn" href="single_product.php?product_id=<?php echo $row['product_id']; ?>">Buy
                        Now</a>
                </div>
            <?php } ?>

            <!-- Pagination bar -->
            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm mt-5">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Previous</span>
                        </a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> -->
        </div>
    </section>

    <!--Footer -->
    <?php include ("layouts/footer.php") ?>
</body>

</html>