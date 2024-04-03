<?php
session_start();
include ("server/connection.php");


if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);

        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
    }
}

if (isset($_POST['change_password'])) {

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    //if passwords dont match
    if ($password !== $confirmPassword) {
        header('location: account.php?error=Passwords don\'t match!');

        //if passwod is less than 6 char
    } else if (strlen($password) < 6) {
        header('location: account.php?error=Password must be at least 6 charachters!');

        //no errors
    } else {
        $stmt = $conn->prepare("UPDATE users SET user_password =? WHERE user_email =? ");
        $hashedPassword = md5($password);
        $stmt->bind_param('ss', $hashedPassword, $user_email);

        if ($stmt->execute()) {
            header('location: account.php?message=Password has been updated successfully!');
        } else {
            header('location: account.php?error=Could not update password!');
        }
    }
}

if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id =? ");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $orders = $stmt->get_result();//[]
}

// Funtion 
// if (isset($_SESSION['logged_in'])) {
//     $user_id = $_SESSION['user_id'];

//     $stmt = $conn->prepare("SELECT order_id,order_cost, user_id, user_phone FROM orders WHERE user_id =? ");
//     $stmt->bind_param('i', $user_id);
//     $stmt->execute();

//     $orders = $stmt->get_result();//[]
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Account</title>
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

    <!-- Account  -->
    <section class="my-5 py-5">
        <div class="row container mx-auto">

            <!-- Thông báo khi thanh toán thành công -->
            <?php if (isset($_GET['payment_message'])) { ?>
                <p class="mt-5 text-center" style="color:green">
                    <?php echo $_GET['payment_message']; ?>
                </p>
            <?php } ?>

            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <p style="color: green;" class="text-center">
                    <?php if (isset($_GET["register_success"])) {
                        echo $_GET["register_success"];
                    } ?>
                </p>
                <p style="color: green;" class="text-center">
                    <?php if (isset($_GET["login_success"])) {
                        echo $_GET["login_success"];
                    } ?>
                </p>
                <h3 class="font-weight-bold">Account info</h3>
                <hr class="mx-auto line" />
                <div class="account-info">
                    <p>Name: <span>
                            <?php if ($_SESSION["user_name"]) {
                                echo $_SESSION["user_name"];
                            } ?>
                        </span></p>
                    <p>Email: <span>
                            <?php if ($_SESSION["user_email"]) {
                                echo $_SESSION["user_email"];
                            } ?>
                        </span></p>
                    <p><a href="#orders" id="order-btn">Your orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php">
                    <p style="color: red;" class="text-center">
                        <?php if (isset($_GET["error"])) {
                            echo $_GET["error"];
                        } ?>
                    </p>
                    <p style="color: green;" class="text-center">
                        <?php if (isset($_GET["message"])) {
                            echo $_GET["message"];
                        } ?>
                    </p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto line" />
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" name="password"
                            placeholder="Password" required />
                    </div>

                    <div class="form-group">
                        <label>Confirm password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword"
                            placeholder="Confirm Password" required />
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password" class="btn"
                            id="change-pass-btn" />
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Order  -->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
            <h2 class="font-weight-bolde text-center">Your Orders</h2>
            <hr class="mx-auto line" />
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Order id</th>
                <th>Order cost</th>
                <th>Order status</th>
                <th>Order date</th>
                <th>Order details</th>
            </tr>
            <?php while ($row = $orders->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <span>
                            <?php echo $row["order_id"]; ?>
                        </span>

                    </td>

                    <td>
                        <span>
                            <?php echo $row["order_cost"]; ?>
                        </span>
                    </td>

                    <td>
                        <span>
                            <?php echo $row["order_status"]; ?>
                        </span>
                    </td>

                    <td>
                        <span>
                            <?php echo $row["order_date"]; ?>
                        </span>
                    </td>

                    <td>
                        <form method="POST" action="order_details.php">
                            <input type="hidden" name="order_status" value="<?php echo $row["order_status"]; ?>" />
                            <input type="hidden" name="order_id" value="<?php echo $row["order_id"]; ?>" />
                            <input type="submit" class="btn order-details-btn" name="order_details_btn" value="details" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>

    <?php include ("layouts/footer.php") ?>
</body>

</html>