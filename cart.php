<?php

session_start();

// Kiểm tra nếu mảng 'cart' chưa tồn tại hoặc là null
if (!isset($_SESSION['cart']) || $_SESSION['cart'] === null) {
    // Khởi tạo mảng 'cart' là một mảng trống
    $_SESSION['cart'] = [];
}

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
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"
                                min="1" step="1" />
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

    <?php include ("layouts/footer.php") ?>
</body>

</html>