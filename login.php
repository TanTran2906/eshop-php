<?php
session_start();
include ("server/connection.php");

if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit;
}
if (isset($_POST['login_btn'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id,user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        $stmt->store_result();


        if ($stmt->num_rows() == 1) {
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success=Logged in successfully!');

        } else {
            header('location: login.php?error=Could not verify your account!');
        }
    }

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/login.css" />
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

    <!-- Login  -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto line" />
        </div>
        <div class="mx-auto container">
            <p style="color: red;" class="text-center">
                <?php if (isset($_GET["error"])) {
                    echo $_GET["error"];
                } ?>
            </p>
            <form id="login-form" method="POST" action="login.php">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password"
                        placeholder="Password" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login" />
                </div>
                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Don't have account? Register
                    </a>
                </div>
            </form>
        </div>
    </section>

    <?php include ("layouts/footer.php") ?>
</body>

</html>