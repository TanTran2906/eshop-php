<?php
session_start(); // Bắt buộc để sử dụng $_SESSION


$order_status = $_POST['order_status'];
$order_total_price = $_POST['order_total_price'];
$order_id = $_POST['order_id'];

// echo '<script>console.log(' . json_encode($order_total_price) . ');</script>'; // In giá trị của 'order_id' lên console


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/checkout.css" />
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

    <!-- Payment  -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto line" />
        </div>
        <div class="mx-auto container text-center">

            <?php if (isset($_POST['order_status']) && $_POST['order_status'] === "not paid") { ?>
                <?php $amount = $_POST['order_total_price']; ?>
                <?php $order_id = $_POST['order_id']; ?>
                <p>Total payment: $
                    <?php echo $_POST['order_total_price']; ?>
                </p>
                <!-- <input class="btn btn-primary" type="submit" value="Pay Now" /> -->
                <!-- Paypal Button  -->
                <div class="mx-auto pt-5" style="width: 50%;">
                    <div id="paypal-button-container" class="mx-auto"></div>

                </div>

            <?php } else if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
                <?php $amount = $_SESSION['total']; ?>
                <?php $order_id = $_SESSION['order_id']; ?>
                    <p>Total payment: $
                    <?php echo $_SESSION['total']; ?>
                    </p>
                    <!-- <input class="btn btn-primary" type="submit" value="Pay Now" /> -->
                    <!-- Paypal Button  -->
                    <div class="mx-auto pt-5" style="width: 50%;">
                        <div id="paypal-button-container" class="mx-auto"></div>
                    </div>

            <?php } else { ?>
                    <p>You don't have an order</p>
            <?php } ?>


        </div>
    </section>

    <!--Footer -->
    <?php include ("layouts/footer.php") ?>

    <p id="result-message"></p>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AYygUvI39mhhnT9q9DWtoma6_YZQ6zvyVkhz12r3dwyKo4glNtlPNXSCTb_pAl52pO4Q0XqGCCPS7-yT&currency=USD">
        </script>
    <script>
        window.paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $amount; ?>'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (orderData) {
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    window.location.href = "server/complete_payment.php?transaction_id=" + transaction.id + "&order_id=" + <?php echo $order_id; ?>;
                });
            }
        }).render("#paypal-button-container");
    </script>
    <!-- <script src="app.js">
        window.paypal.Buttons({}).render("#paypal-button-container");
    </script> -->
</body>

</html>