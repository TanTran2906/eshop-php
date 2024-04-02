<?php
session_start();
include ('server/connection.php');

$order_id = $_POST['order_id'];
$order_status = $_POST['order_status'];

// echo '<script>console.log(' . json_encode($order_id) . ');</script>'; // In giá trị của 'order_id' lên console

// Sử dụng order_id để truy vấn cơ sở dữ liệu
$stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->bind_param('i', $order_id);
$stmt->execute();

// Lấy kết quả của truy vấn
$order_details = $stmt->get_result();

//Tính tổng đơn
$order_total_price = calculateTotalOrderPrice($order_details);

function calculateTotalOrderPrice($order_details)
{

    $total = 0;

    foreach ($order_details as $row) {

        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);

        return $total;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/account.css" />
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

    <!-- Order details  -->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-5 pt-5">
            <h2 class="font-weight-bolde text-center">Order details</h2>
            <hr class="mx-auto line" />
        </div>

        <!-- Table  -->
        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quanity</th>
            </tr>
            <?php foreach ($order_details as $row) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/img/<?php echo $row["product_image"]; ?>" />
                            <div>
                                <p class="mt-3">
                                    <?php echo $row["product_name"]; ?>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span>
                            $
                            <?php echo $row["product_price"]; ?>
                        </span>
                    </td>

                    <td>
                        <span>
                            <?php echo $row["product_quantity"]; ?>
                        </span>
                    </td>

                </tr>
            <?php } ?>
        </table>


        <?php if ($order_status == "not paid") { ?>
            <form style="float: right;" method="POST" action="payment.php">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" />
                <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" />
                <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now" />
            </form>

        <?php } ?>

    </section>

    <?php include ("layouts/footer.php") ?>
</body>

</html>