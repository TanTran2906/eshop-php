<?php

session_start();

if (isset($_POST['add_to_cart'])) {

    //if user has already added a product to cart
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id"); // [2, 3,4, 10, 15]
        //if product has already been added to cart or not
        if (!in_array($_POST['product_id'], $products_array_ids)) {
            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$product_id] = $product_array;
            // [ 2=>[] , 3=>[], 5=>[] ]
            //product has already been added
        } else {
            echo '<script>alert("Product was already to cart");</script>';
        }

    }
    //if this is the first product
    else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity

        );

        $_SESSION['cart'][$product_id] = $product_array;
        // [ 2=>[] , 3=>[], 5=>[] ]

    }

    calculateTotalCart();
}
//Remove product from cart
else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    echo '<script>console.log(' . json_encode($product_id) . ');</script>'; // In giá trị của 'product_id' lên console
    unset($_SESSION['cart'][$product_id]);

    calculateTotalCart();
} else if (isset($_POST['edit_quantity'])) {

    //we get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product quantity
    $product_array['product_quantity'] = $product_quantity;

    //return array back its place
    $_SESSION['cart'][$product_id] = $product_array;

    calculateTotalCart();

} else {
    // header('location: index.php');
}


function calculateTotalCart()
{
    $total = 0;

    // Kiểm tra nếu giỏ hàng không rỗng
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $price = $value['product_price'];
            $quantity = $value['product_quantity'];
            $total += $price * $quantity;
        }
    }

    $_SESSION['total'] = $total;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/cart.css" />
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

    <!-- Cart  -->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr class="line" />
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/img/<?php echo trim($value['product_image']); ?>" />
                            <div>
                                <p>
                                    <?php echo $value['product_name']; ?>
                                </p>
                                <small><span>$</span>
                                    <?php echo $value['product_price']; ?>
                                </small>
                                <br />

                                <!-- Remove from cart  -->
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                                    <input type="submit" name="remove_product" class="remove-btn" value="Remove" />
                                </form>

                            </div>
                        </div>
                    </td>

                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                            <input type="number" name="product_quantity"
                                value="<?php echo $value['product_quantity']; ?>" />
                            <input type="submit" class="edit-btn" value="Edit" name="edit_quantity" />
                        </form>
                    </td>


                    <td>
                        <span>$</span>
                        <span class="product-price">
                            <?php echo $value['product_quantity'] * $value['product_price']; ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <!-- Total - Amount  -->
        <div class="cart-total">
            <table>
                <!-- <tr>
                    <td>Subtotal</td>
                    <td>$155</td>
                </tr> -->

                <tr>
                    <td>Total</td>
                    <td>$
                        <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : '0'; ?>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Button  -->
        <div class="checkout-container">
            <form method="POST" action="checkout.php">
                <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout" />
            </form>
        </div>

    </section>

    <!--Footer -->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="./assets/img/logo.png" />
                <p class="pt-3">
                    We provide the best products for the most affordable
                    prices
                </p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">men</a></li>
                    <li><a href="#">women</a></li>
                    <li><a href="#">boys</a></li>
                    <li><a href="#">girls</a></li>
                    <li><a href="#">new arrivals</a></li>
                    <li><a href="#">clothes</a></li>
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>1234 Street Name, City</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>123 456 7890</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>info@email.com</p>
                </div>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img src="assets/img/featured1.jpg" class="img-fluid w-25 h-100 m-2" />
                    <img src="assets/img/featured2.jpg" class="img-fluid w-25 h-100 m-2" />
                    <img src="assets/img/featured3.jpg" class="img-fluid w-25 h-100 m-2" />
                    <img src="assets/img/featured4.jpg" class="img-fluid w-25 h-100 m-2" />
                    <img src="assets/img/dell1.jpg" class="img-fluid w-25 h-100 m-2" />
                </div>
            </div>

            <div class="copyright mt-5">
                <div class="row container mx-auto">
                    <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                        <img src="assets/img/payment.jpg" />
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                        <p>eCommerce @2024 All Right Reserved</p>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- <Script> -->
    <script src="https://kit.fontawesome.com/5d5834f6a4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>